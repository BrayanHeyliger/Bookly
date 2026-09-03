<?php

namespace Bookly\Controllers;

use Bookly\Support\AddonManager;
use Bookly\Support\DB;

class ApiController
{
    public static function handle(string $uri, string $method, DB $db, AddonManager $addons): void
    {
        header('Content-Type: application/json');
        if (preg_match('#^/api/services/([a-z0-9-]+)$#', $uri, $m)) {
            echo json_encode($db->all('SELECT * FROM services WHERE business_id = (SELECT id FROM businesses WHERE slug = ?) AND is_active = 1', [$m[1]]));
            return;
        }
        if (preg_match('#^/api/slots/([a-z0-9-]+)/(\d+)/([0-9-]+)$#', $uri, $m)) {
            $b = $db->first('SELECT id FROM businesses WHERE slug = ?', [$m[1]]);
            $svc = $db->first('SELECT * FROM services WHERE id = ?', [$m[2]]);
            $booked = array_column($db->all("SELECT start_at FROM bookings WHERE service_id = ? AND date(start_at) = ?", [$svc['id'], $m[3]]), 'start_at');
            $booked = array_map(fn ($d) => date('H:i', strtotime($d)), $booked);
            $slots = [];
            for ($h = 9; $h < 20; $h++) {
                for ($mi = 0; $mi < 60; $mi += 15) {
                    $t = sprintf('%02d:%02d', $h, $mi);
                    if (! in_array($t, $booked) && strtotime($m[3].' '.$t) > time() + 3600) {
                        $slots[] = $t;
                    }
                }
            }
            echo json_encode($slots);
            return;
        }
        if ($uri === '/api/addons/active') {
            echo json_encode($addons->activeSlugs());
            return;
        }
        http_response_code(404);
        echo json_encode(['error' => 'not found']);
    }
}
