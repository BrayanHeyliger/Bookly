<?php

namespace Bookly\Controllers;

use Bookly\Support\DB;
use Bookly\Support\AddonManager;

class PublicBookingController
{
    public static function handle(string $uri, string $method, DB $db): void
    {
        if (preg_match('#^/book/([a-z0-9-]+)/?$#', $uri, $m)) {
            self::show($db, $m[1], $method);
            return;
        }
        if (preg_match('#^/book/([a-z0-9-]+)/thanks/(\d+)$#', $uri, $m)) {
            self::thanks($db, $m[2]);
            return;
        }
        http_response_code(404);
        echo 'Not found';
    }

    public static function show(DB $db, string $slug, string $method): void
    {
        $b = $db->first('SELECT * FROM businesses WHERE slug = ?', [$slug]);
        if (! $b) { http_response_code(404); echo 'Business not found'; return; }
        if ($method === 'POST') {
            $service = $db->first('SELECT * FROM services WHERE id = ? AND business_id = ?', [$_POST['service_id'], $b['id']]);
            if (! $service) { http_response_code(400); echo 'Invalid service'; return; }
            $start = strtotime($_POST['date'].' '.$_POST['time']);
            $end = $start + $service['duration'] * 60;

            // Find or create client
            $email = trim($_POST['email']);
            $client = $db->first('SELECT * FROM clients WHERE business_id = ? AND email = ?', [$b['id'], $email]);
            if (! $client) {
                $db->insert('clients', [
                    'business_id' => $b['id'],
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $email,
                    'phone' => $_POST['phone'] ?? '',
                    'is_favorite' => 0,
                    'total_visits' => 0,
                    'total_spent' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $client = $db->first('SELECT * FROM clients WHERE business_id = ? AND email = ?', [$b['id'], $email]);
            }

            $bookingId = $db->insert('bookings', [
                'business_id' => $b['id'],
                'service_id' => $service['id'],
                'client_id' => $client['id'],
                'start_at' => date('Y-m-d H:i:s', $start),
                'end_at' => date('Y-m-d H:i:s', $end),
                'status' => 'confirmed',
                'price' => $service['price'],
                'deposit' => $service['deposit'],
                'payment_status' => 'pending',
                'notes' => $_POST['notes'] ?? '',
                'source' => 'public',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            redirect('/book/'.$slug.'/thanks/'.$bookingId);
        }
        $services = $db->all('SELECT * FROM services WHERE business_id = ? AND is_active = 1 ORDER BY position', [$b['id']]);
        layout('public', ['_view' => 'bookings.public.show', 'business' => $b, 'services' => $services]);
    }

    public static function thanks(DB $db, int $bookingId): void
    {
        $booking = $db->first('SELECT b.*, s.name AS service_name FROM bookings b LEFT JOIN services s ON s.id = b.service_id WHERE b.id = ?', [$bookingId]);
        layout('public', ['_view' => 'bookings.public.thanks', 'booking' => $booking]);
    }
}
