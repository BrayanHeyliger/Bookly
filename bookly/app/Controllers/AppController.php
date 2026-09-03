<?php

namespace Bookly\Controllers;

use Bookly\Support\AddonManager;
use Bookly\Support\DB;
use Bookly\Models\User;

class AppController
{
    public static function handle(string $uri, string $method, DB $db, ?array $user, AddonManager $addons): void
    {
        if ($uri === '/' || $uri === '/dashboard')    { self::dashboard($db, $user, $addons); return; }
        if ($uri === '/calendar')                     { self::calendar($db, $user, $method); return; }
        if (str_starts_with($uri, '/bookings'))       { self::bookings($db, $user, $uri, $method); return; }
        if (str_starts_with($uri, '/services'))       { self::services($db, $user, $uri, $method); return; }
        if ($uri === '/clients')                      { self::clients($db, $user); return; }
        if ($uri === '/reviews')                      { self::reviews($db, $user); return; }
        if ($uri === '/reports')                      { self::reports($db, $user); return; }
        if (str_starts_with($uri, '/settings'))       { self::settings($db, $user, $method); return; }
        if (str_starts_with($uri, '/addons'))         { self::addons($addons, $uri, $method); return; }
        if ($uri === '/profile')                      { self::profile($db, $user, $method); return; }
        if ($uri === '/staff')                        { self::staff($db, $user, $method); return; }
        if ($uri === '/hours')                        { self::hours($db, $user, $method); return; }
        if ($uri === '/notifications')                { self::notifications($db, $user); return; }
        http_response_code(404); echo 'Page not found';
    }

    protected static function business(DB $db, ?array $user): array
    {
        $b = $db->first('SELECT * FROM businesses ORDER BY id LIMIT 1');
        return $b ?: [];
    }

    public static function dashboard(DB $db, ?array $user, AddonManager $addons): void
    {
        $b = self::business($db, $user);
        $bid = $b['id'] ?? 0;
        $todayBookings = (int) $db->first("SELECT COUNT(*) AS c FROM bookings WHERE business_id = ? AND date(start_at) = date('now')", [$bid])['c'];
        $weekRevenue = (float) $db->first("SELECT COALESCE(SUM(price),0) AS s FROM bookings WHERE business_id = ? AND status = 'completed' AND start_at BETWEEN datetime('now','weekday 0','-7 days') AND datetime('now','weekday 0')", [$bid])['s'];
        $newClients = (int) $db->first("SELECT COUNT(*) AS c FROM clients WHERE business_id = ? AND created_at >= datetime('now','-30 days')", [$bid])['c'];
        $upcoming = $db->all("SELECT b.*, s.name AS service_name, c.first_name AS client_name, u.name AS staff_name
                              FROM bookings b
                              LEFT JOIN services s ON s.id = b.service_id
                              LEFT JOIN clients c ON c.id = b.client_id
                              LEFT JOIN users u ON u.id = b.staff_id
                              WHERE b.business_id = ? AND b.start_at >= datetime('now')
                              ORDER BY b.start_at LIMIT 5", [$bid]);
        $recent = $db->all("SELECT b.*, s.name AS service_name, c.first_name AS client_name
                            FROM bookings b
                            LEFT JOIN services s ON s.id = b.service_id
                            LEFT JOIN clients c ON c.id = b.client_id
                            WHERE b.business_id = ?
                            ORDER BY b.start_at DESC LIMIT 10", [$bid]);
        $chart = $db->all("SELECT date(start_at) AS day, COUNT(*) AS c, COALESCE(SUM(price),0) AS total
                           FROM bookings WHERE business_id = ? AND start_at >= datetime('now','-13 days')
                           GROUP BY date(start_at) ORDER BY day", [$bid]);
        $allAddons = $addons->all();
        $addonsInstalled = count(array_filter($allAddons, fn ($a) => $a['is_installed']));
        $addonsTotal = count($allAddons);

        layout('app', [
            '_view' => 'dashboard.index',
            'title' => 'Dashboard',
            'subtitle' => $b['name'] ?? 'Welcome to Bookly',
            'business' => $b, 'todayBookings' => $todayBookings, 'weekRevenue' => $weekRevenue,
            'newClients' => $newClients, 'upcoming' => $upcoming, 'recent' => $recent,
            'chart' => $chart, 'addonsInstalled' => $addonsInstalled, 'addonsTotal' => $addonsTotal,
            'user' => $user, 'addons' => $addons,
        ]);
    }

    public static function calendar(DB $db, ?array $user, string $method): void
    {
        $b = self::business($db, $user);
        $bid = $b['id'] ?? 0;
        $date = $_GET['date'] ?? date('Y-m-d');
        $start = date('Y-m-d', strtotime('monday this week', strtotime($date)));
        $end = date('Y-m-d', strtotime('sunday this week', strtotime($date)));
        $bookings = $db->all("SELECT b.*, s.name AS service_name, c.first_name AS client_name, u.name AS staff_name
                              FROM bookings b
                              LEFT JOIN services s ON s.id = b.service_id
                              LEFT JOIN clients c ON c.id = b.client_id
                              LEFT JOIN users u ON u.id = b.staff_id
                              WHERE b.business_id = ? AND date(b.start_at) BETWEEN ? AND ?
                              ORDER BY b.start_at", [$bid, $start, $end]);
        layout('app', [
            '_view' => 'calendar.index',
            'title' => 'Calendar',
            'subtitle' => 'Weekly view of all bookings',
            'bookings' => $bookings, 'date' => $date, 'start' => $start, 'end' => $end,
            'user' => $user,
        ]);
    }

    public static function bookings(DB $db, ?array $user, string $uri, string $method): void
    {
        $b = self::business($db, $user);
        $bid = $b['id'] ?? 0;
        if (preg_match('#^/bookings/(\d+)$#', $uri, $m)) {
            $booking = $db->first('SELECT b.*, s.name AS service_name, c.first_name AS client_name, c.last_name AS client_last, c.email AS client_email, c.phone AS client_phone, u.name AS staff_name
                                   FROM bookings b
                                   LEFT JOIN services s ON s.id = b.service_id
                                   LEFT JOIN clients c ON c.id = b.client_id
                                   LEFT JOIN users u ON u.id = b.staff_id
                                   WHERE b.id = ?', [$m[1]]);
            if ($method === 'POST' && ($_POST['_method'] ?? '') === 'DELETE') {
                $db->delete('bookings', 'id = ?', [$m[1]]);
                flash('ok', 'Booking deleted.');
                redirect('/bookings');
            }
            layout('app', ['_view' => 'bookings.show', 'title' => 'Booking #'.$m[1], 'booking' => $booking, 'user' => $user]);
            return;
        }
        $status = $_GET['status'] ?? '';
        $sql = "SELECT b.*, s.name AS service_name, c.first_name AS client_name, u.name AS staff_name
                FROM bookings b
                LEFT JOIN services s ON s.id = b.service_id
                LEFT JOIN clients c ON c.id = b.client_id
                LEFT JOIN users u ON u.id = b.staff_id
                WHERE b.business_id = ?";
        $params = [$bid];
        if ($status) { $sql .= ' AND b.status = ?'; $params[] = $status; }
        $sql .= ' ORDER BY b.start_at DESC LIMIT 50';
        $bookings = $db->all($sql, $params);
        layout('app', ['_view' => 'bookings.index', 'title' => 'Bookings', 'subtitle' => 'All appointments', 'bookings' => $bookings, 'user' => $user]);
    }

    public static function services(DB $db, ?array $user, string $uri, string $method): void
    {
        $b = self::business($db, $user);
        $bid = $b['id'] ?? 0;
        if (preg_match('#^/services/(\d+)/edit$#', $uri, $m) && $method === 'GET') {
            $svc = $db->first('SELECT * FROM services WHERE id = ? AND business_id = ?', [$m[1], $bid]);
            layout('app', ['_view' => 'services.edit', 'title' => 'Edit service', 'service' => $svc, 'user' => $user]);
            return;
        }
        if (preg_match('#^/services/(\d+)/edit$#', $uri, $m) && $method === 'GET') {
            $svc = $db->first('SELECT * FROM services WHERE id = ? AND business_id = ?', [$m[1], $bid]);
            layout('app', ['_view' => 'services.edit', 'title' => 'Edit service', 'service' => $svc, 'user' => $user]);
            return;
        }
        if (preg_match('#^/services/(\d+)$#', $uri, $m) && $method === 'POST') {
            if (! hash_equals($_SESSION['csrf'] ?? '', $_POST['_token'] ?? '')) { http_response_code(419); echo 'CSRF'; return; }
            if (($_POST['_method'] ?? '') === 'DELETE') {
                $db->delete('services', 'id = ? AND business_id = ?', [$m[1], $bid]);
                flash('ok', 'Service deleted.');
                redirect('/services');
            }
            $db->update('services', [
                'name' => trim($_POST['name'] ?? ''),
                'duration' => (int)($_POST['duration'] ?? 30),
                'price' => (float)($_POST['price'] ?? 0),
                'description' => trim($_POST['description'] ?? ''),
                'is_active' => isset($_POST['is_active']) ? 1 : 0,
                'updated_at' => date('Y-m-d H:i:s'),
            ], 'id = ? AND business_id = ?', [$m[1], $bid]);
            flash('ok', 'Service updated.');
            redirect('/services');
        }
        if ($uri === '/services' && $method === 'POST') {
            if (! hash_equals($_SESSION['csrf'] ?? '', $_POST['_token'] ?? '')) { http_response_code(419); echo 'CSRF'; return; }
            $db->insert('services', [
                'business_id' => $bid,
                'name' => trim($_POST['name'] ?? 'New Service'),
                'duration' => (int)($_POST['duration'] ?? 30),
                'price' => (float)($_POST['price'] ?? 0),
                'description' => trim($_POST['description'] ?? ''),
                'is_active' => 1,
                'position' => 999,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            flash('ok', 'Service created.');
            redirect('/services');
        }
        $services = $db->all('SELECT * FROM services WHERE business_id = ? ORDER BY position, name', [$bid]);
        layout('app', ['_view' => 'services.index', 'title' => 'Services', 'subtitle' => 'Manage your offerings', 'services' => $services, 'user' => $user]);
    }

    public static function clients(DB $db, ?array $user): void
    {
        $b = self::business($db, $user);
        $bid = $b['id'] ?? 0;
        if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
            $client = $db->first('SELECT * FROM clients WHERE id = ? AND business_id = ?', [(int)$_GET['edit'], $bid]);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (! hash_equals($_SESSION['csrf'] ?? '', $_POST['_token'] ?? '')) { http_response_code(419); echo 'CSRF'; return; }
                $db->update('clients', [
                    'first_name' => trim($_POST['first_name'] ?? ''),
                    'last_name' => trim($_POST['last_name'] ?? ''),
                    'email' => trim($_POST['email'] ?? ''),
                    'phone' => trim($_POST['phone'] ?? ''),
                    'notes' => trim($_POST['notes'] ?? ''),
                    'is_favorite' => isset($_POST['is_favorite']) ? 1 : 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ], 'id = ? AND business_id = ?', [(int)$_GET['edit'], $bid]);
                flash('ok', 'Client updated.');
                redirect('/clients');
            }
            layout('app', ['_view' => 'clients.edit', 'title' => 'Edit client', 'client' => $client, 'user' => $user]);
            return;
        }
        $clients = $db->all('SELECT * FROM clients WHERE business_id = ? ORDER BY created_at DESC LIMIT 50', [$bid]);
        layout('app', ['_view' => 'clients.index', 'title' => 'Clients', 'subtitle' => 'Your customer CRM', 'clients' => $clients, 'user' => $user]);
    }

    public static function reviews(DB $db, ?array $user): void
    {
        $reviews = $db->all("SELECT r.*, b.name AS business_name FROM reviews r LEFT JOIN businesses b ON b.id = r.business_id ORDER BY r.created_at DESC LIMIT 30");
        layout('app', ['_view' => 'reviews.index', 'title' => 'Reviews', 'reviews' => $reviews, 'user' => $user]);
    }

    public static function reports(DB $db, ?array $user): void
    {
        $b = self::business($db, $user);
        $bid = $b['id'] ?? 0;
        $from = $_GET['from'] ?? date('Y-m-d', strtotime('-30 days'));
        $to = $_GET['to'] ?? date('Y-m-d');
        $revenue = (float) $db->first("SELECT COALESCE(SUM(price),0) AS s FROM bookings WHERE business_id = ? AND status = 'completed' AND date(start_at) BETWEEN ? AND ?", [$bid, $from, $to])['s'];
        $count = (int) $db->first("SELECT COUNT(*) AS c FROM bookings WHERE business_id = ? AND date(start_at) BETWEEN ? AND ?", [$bid, $from, $to])['c'];
        $rows = $db->all("SELECT s.name AS service_name, COUNT(b.id) AS c, COALESCE(SUM(b.price),0) AS total
                          FROM bookings b LEFT JOIN services s ON s.id = b.service_id
                          WHERE b.business_id = ? AND date(b.start_at) BETWEEN ? AND ?
                          GROUP BY s.id ORDER BY total DESC", [$bid, $from, $to]);
        layout('app', ['_view' => 'reports.index', 'title' => 'Reports', 'revenue' => $revenue, 'count' => $count, 'rows' => $rows, 'from' => $from, 'to' => $to, 'user' => $user]);
    }

    public static function settings(DB $db, ?array $user, string $method): void
    {
        $b = self::business($db, $user);
        if ($method === 'POST') {
            $data = array_intersect_key($_POST, array_flip(['name','email','phone','description','address','city','country','timezone','currency']));
            $data = array_map('trim', $data);
            if (! empty($data['name'])) {
                $db->update('businesses', $data + ['updated_at' => date('Y-m-d H:i:s')], 'id = ?', [$b['id']]);
                flash('ok', 'Settings saved.');
            }
            redirect('/settings');
        }
        layout('app', ['_view' => 'settings.index', 'title' => 'Settings', 'business' => $b, 'user' => $user]);
    }

    public static function addons(AddonManager $addons, string $uri, string $method): void
    {
        if ($uri === '/addons') {
            $all = $addons->all();
            $grouped = [];
            foreach ($all as $a) {
                $grouped[$a['category']][] = $a;
            }
            layout('app', ['_view' => 'addons.index', 'title' => 'Addon Marketplace', 'subtitle' => 'Supercharge Bookly with modular addons', 'grouped' => $grouped, 'addons' => $all, 'user' => $_SESSION['user_id'] ?? null]);
            return;
        }
        if (preg_match('#^/addons/([a-z_]+)/install$#', $uri, $m) && $method === 'POST') {
            if (! hash_equals($_SESSION['csrf'] ?? '', $_POST['_token'] ?? '')) { http_response_code(419); echo 'CSRF'; return; }
            $addons->install($m[1]);
            flash('ok', ucwords(str_replace('_',' ', $m[1])).' installed.');
            redirect('/addons');
        }
        if (preg_match('#^/addons/([a-z_]+)/uninstall$#', $uri, $m) && $method === 'POST') {
            if (! hash_equals($_SESSION['csrf'] ?? '', $_POST['_token'] ?? '')) { http_response_code(419); echo 'CSRF'; return; }
            $addons->uninstall($m[1]);
            flash('ok', ucwords(str_replace('_',' ', $m[1])).' uninstalled.');
            redirect('/addons');
        }
        if (preg_match('#^/addons/([a-z_]+)/toggle$#', $uri, $m) && $method === 'POST') {
            if (! hash_equals($_SESSION['csrf'] ?? '', $_POST['_token'] ?? '')) { http_response_code(419); echo 'CSRF'; return; }
            $addons->toggle($m[1]);
            flash('ok', 'Toggled.');
            redirect('/addons');
        }
        http_response_code(404);
    }

    public static function profile(DB $db, ?array $user, string $method): void
    {
        if ($method === 'POST') {
            if (! hash_equals($_SESSION['csrf'] ?? '', $_POST['_token'] ?? '')) { http_response_code(419); echo 'CSRF'; return; }
            if (! empty($_POST['password'])) {
                $db->update('users', [
                    'name' => trim($_POST['name'] ?? ''),
                    'email' => trim($_POST['email'] ?? ''),
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'updated_at' => date('Y-m-d H:i:s'),
                ], 'id = ?', [$user['id']]);
            } else {
                $db->update('users', [
                    'name' => trim($_POST['name'] ?? ''),
                    'email' => trim($_POST['email'] ?? ''),
                    'updated_at' => date('Y-m-d H:i:s'),
                ], 'id = ?', [$user['id']]);
            }
            flash('ok', 'Profile updated.');
            redirect('/profile');
        }
        layout('app', ['_view' => 'profile.index', 'title' => 'Profile', 'user' => $user]);
    }

    public static function staff(DB $db, ?array $user, string $method): void
    {
        $b = self::business($db, $user);
        $bid = $b['id'] ?? 0;
        if ($method === 'POST') {
            if (! hash_equals($_SESSION['csrf'] ?? '', $_POST['_token'] ?? '')) { http_response_code(419); echo 'CSRF'; return; }
            $action = $_POST['action'] ?? '';
            if ($action === 'create' || $action === 'update') {
                $data = [
                    'business_id' => $bid,
                    'name' => trim($_POST['name'] ?? ''),
                    'email' => trim($_POST['email'] ?? ''),
                    'role' => trim($_POST['role'] ?? 'staff'),
                    'is_active' => isset($_POST['is_active']) ? 1 : 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                if ($action === 'create') {
                    $data['password'] = password_hash(trim($_POST['password'] ?? 'changeme'), PASSWORD_DEFAULT);
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $db->insert('users', $data);
                    $db->insert('role_user', ['user_id' => $db->lastInsertId(), 'role_id' => 3, 'business_id' => $bid]);
                    flash('ok', 'Staff member added.');
                } else {
                    $id = (int)($_POST['id'] ?? 0);
                    $db->update('users', $data, 'id = ? AND business_id = ?', [$id, $bid]);
                    flash('ok', 'Staff member updated.');
                }
            } elseif ($action === 'delete' && ! empty($_POST['id'])) {
                $db->delete('users', 'id = ? AND business_id = ?', [(int)$_POST['id'], $bid]);
                flash('ok', 'Staff member removed.');
            }
            redirect('/staff');
        }
        $staff = $db->all("SELECT u.* FROM users u LEFT JOIN role_user ru ON ru.user_id = u.id LEFT JOIN business_user bu ON bu.user_id = u.id WHERE bu.business_id = ? ORDER BY u.name", [$bid]);
        layout('app', ['_view' => 'staff.index', 'title' => 'Staff', 'subtitle' => 'Manage your team', 'staff' => $staff, 'user' => $user]);
    }

    public static function hours(DB $db, ?array $user, string $method): void
    {
        $b = self::business($db, $user);
        $bid = $b['id'] ?? 0;
        if ($method === 'POST') {
            if (! hash_equals($_SESSION['csrf'] ?? '', $_POST['_token'] ?? '')) { http_response_code(419); echo 'CSRF'; return; }
            $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
            foreach ($days as $d) {
                $existing = $db->first('SELECT id FROM business_hours WHERE business_id = ? AND day = ?', [$bid, $d]);
                $data = [
                    'business_id' => $bid,
                    'day' => $d,
                    'open' => trim($_POST[$d.'_open'] ?? '09:00'),
                    'close' => trim($_POST[$d.'_close'] ?? '18:00'),
                    'is_closed' => isset($_POST[$d.'_closed']) ? 1 : 0,
                ];
                if ($existing) $db->update('business_hours', $data, 'id = ?', [$existing['id']]);
                else $db->insert('business_hours', $data + ['created_at' => date('Y-m-d H:i:s')]);
            }
            flash('ok', 'Business hours saved.');
            redirect('/hours');
        }
        $hours = $db->all('SELECT * FROM business_hours WHERE business_id = ? ORDER BY CASE day WHEN "monday" THEN 1 WHEN "tuesday" THEN 2 WHEN "wednesday" THEN 3 WHEN "thursday" THEN 4 WHEN "friday" THEN 5 WHEN "saturday" THEN 6 WHEN "sunday" THEN 7 END', [$bid]);
        $map = [];
        foreach ($hours as $h) $map[$h['day']] = $h;
        layout('app', ['_view' => 'settings.hours', 'title' => 'Business Hours', 'subtitle' => 'Set your opening hours', 'hours' => $map, 'user' => $user]);
    }

    public static function notifications(DB $db, ?array $user): void
    {
        $b = self::business($db, $user);
        $bid = $b['id'] ?? 0;
        $notifications = $db->all("SELECT n.*, b.name AS business_name FROM notifications n LEFT JOIN businesses b ON b.id = n.business_id WHERE n.business_id = ? ORDER BY n.created_at DESC LIMIT 50", [$bid]);
        layout('app', ['_view' => 'notifications.index', 'title' => 'Notifications', 'subtitle' => 'Recent alerts', 'notifications' => $notifications, 'user' => $user]);
    }
}
