<?php
/**
 * Bookly — front controller for hosts whose document root is the project root
 * (not public/). Routed to by bookly/.htaccess on Apache shared hosting.
 *
 * Refuses to serve anything under storage/, then delegates to the application.
 */

define('BOOKLY_ROOT_PATH', __DIR__);

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Never expose the database, the install lock or the rate-limit buckets.
if (preg_match('#^/storage/#', $path)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Forbidden.';
    exit;
}

require __DIR__.'/index.php';
