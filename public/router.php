<?php

/**
 * Bookly — router script for PHP's built-in server.
 *
 * Returns false for real files so the server serves them directly, and
 * funnels everything else into the application's front controller.
 */
$root = dirname(__DIR__);
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Real files under public/ are served as-is.
$candidate = $root.'/public'.$path;
if ($path !== '/' && is_file($candidate)) {
    return false;
}

$bootstrap = is_file($root.'/bookly/public/index.php')
    ? $root.'/bookly/public/index.php'
    : $root.'/bookly/index.php';

if (! is_file($bootstrap)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Bookly bootstrap not found.';
    return true;
}

require $bootstrap;
return true;
