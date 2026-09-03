<?php

namespace Bookly\Controllers;

use Bookly\Support\DB;

class MarketplaceController
{
    public static function handle(string $uri, string $method, DB $db): void
    {
        if ($uri === '/explore' || $uri === '/') {
            self::explore($db);
            return;
        }
        if (preg_match('#^/category/([a-z0-9-]+)$#', $uri, $m)) {
            self::category($db, $m[1]);
            return;
        }
        if (preg_match('#^/city/([a-z0-9-]+(?:-[a-z0-9-]+)*)$#', $uri, $m)) {
            self::city($db, $m[1]);
            return;
        }
        if (preg_match('#^/business/([a-z0-9-]+)$#', $uri, $m)) {
            self::business($db, $m[1]);
            return;
        }
        if ($uri === '/search') {
            self::search($db);
            return;
        }
        http_response_code(404);
        echo 'Page not found';
    }

    public static function explore(DB $db): void
    {
        $categories = $db->all('SELECT DISTINCT category, COUNT(*) AS cnt FROM businesses WHERE category IS NOT NULL AND category != "" GROUP BY category ORDER BY cnt DESC LIMIT 20');
        $cities = $db->all('SELECT DISTINCT city, COUNT(*) AS cnt FROM businesses WHERE city IS NOT NULL AND city != "" GROUP BY city ORDER BY cnt DESC LIMIT 30');
        $featured = $db->all('SELECT b.*, COUNT(r.id) AS review_count, COALESCE(AVG(r.rating), 0) AS avg_rating FROM businesses b LEFT JOIN reviews r ON r.business_id = b.id WHERE b.is_active = 1 GROUP BY b.id ORDER BY avg_rating DESC, review_count DESC LIMIT 12');
        $recent = $db->all('SELECT b.*, COUNT(r.id) AS review_count FROM businesses b LEFT JOIN reviews r ON r.business_id = b.id WHERE b.is_active = 1 GROUP BY b.id ORDER BY b.created_at DESC LIMIT 12');
        layout('public', ['_view' => 'marketplace.explore', 'title' => 'Explore — Bookly', 'categories' => $categories, 'cities' => $cities, 'featured' => $featured, 'recent' => $recent]);
    }

    public static function category(DB $db, string $slug): void
    {
        $cat = str_replace('-', ' ', $slug);
        $businesses = $db->all('SELECT b.*, COUNT(r.id) AS review_count, COALESCE(AVG(r.rating), 0) AS avg_rating FROM businesses b LEFT JOIN reviews r ON r.business_id = b.id WHERE b.category LIKE ? AND b.is_active = 1 GROUP BY b.id ORDER BY avg_rating DESC LIMIT 50', [$cat]);
        layout('public', ['_view' => 'marketplace.category', 'title' => ucfirst($cat).' — Bookly', 'category' => $cat, 'businesses' => $businesses]);
    }

    public static function city(DB $db, string $slug): void
    {
        $city = str_replace('-', ' ', $slug);
        $businesses = $db->all('SELECT b.*, COUNT(r.id) AS review_count, COALESCE(AVG(r.rating), 0) AS avg_rating FROM businesses b LEFT JOIN reviews r ON r.business_id = b.id WHERE b.city LIKE ? AND b.is_active = 1 GROUP BY b.id ORDER BY avg_rating DESC LIMIT 50', [$city]);
        layout('public', ['_view' => 'marketplace.city', 'title' => ucfirst($city).' — Bookly', 'city' => $city, 'businesses' => $businesses]);
    }

    public static function business(DB $db, string $slug): void
    {
        $b = $db->first('SELECT * FROM businesses WHERE slug = ?', [$slug]);
        if (! $b) { http_response_code(404); echo 'Business not found'; return; }
        $services = $db->all('SELECT * FROM services WHERE business_id = ? AND is_active = 1 ORDER BY position', [$b['id']]);
        $reviews = $db->all('SELECT r.*, u.name AS user_name FROM reviews r LEFT JOIN users u ON u.id = r.user_id WHERE r.business_id = ? ORDER BY r.created_at DESC LIMIT 20', [$b['id']]);
        $avg = (float) ($db->first('SELECT COALESCE(AVG(rating),0) AS a FROM reviews WHERE business_id = ?', [$b['id']])['a'] ?? 0);
        $cnt = (int) ($db->first('SELECT COUNT(*) AS c FROM reviews WHERE business_id = ?', [$b['id']])['c'] ?? 0);
        layout('public', ['_view' => 'marketplace.business', 'title' => $b['name'].' — Bookly', 'business' => $b, 'services' => $services, 'reviews' => $reviews, 'avg_rating' => $avg, 'review_count' => $cnt]);
    }

    public static function search(DB $db): void
    {
        $q = trim($_GET['q'] ?? '');
        $businesses = [];
        if ($q !== '') {
            $param = "%$q%";
            $businesses = $db->all('SELECT b.*, COUNT(r.id) AS review_count, COALESCE(AVG(r.rating), 0) AS avg_rating FROM businesses b LEFT JOIN reviews r ON r.business_id = b.id WHERE b.is_active = 1 AND (b.name LIKE ? OR b.description LIKE ? OR b.category LIKE ? OR b.city LIKE ?) GROUP BY b.id ORDER BY avg_rating DESC LIMIT 50', array_fill(0, 4, $param));
        }
        layout('public', ['_view' => 'marketplace.search', 'title' => 'Search — Bookly', 'query' => $q, 'businesses' => $businesses]);
    }
}
