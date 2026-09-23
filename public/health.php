<?php
/**
 * Bookly — container health probe.
 *
 * Touches the database and reports JSON, so Render can tell a live service
 * from one that booted but cannot reach storage.
 */
header('Content-Type: application/json');

define('BOOKLY_ROOT_PATH', dirname(__DIR__));

require BOOKLY_ROOT_PATH.'/bootstrap.php';

try {
    Bookly\Support\DB::instance();
    echo json_encode([
        'ok' => true,
        'php' => PHP_VERSION,
        'installed' => file_exists(BOOKLY_ROOT.'/storage/installed.lock'),
    ]);
} catch (\Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'database unavailable']);
}
