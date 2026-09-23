<?php

/**
 * Bookly — router script for PHP's built-in server.
 *
 * Returns false for real files so the server serves them directly, and funnels
 * everything else into the application's front controller.
 *
 * Tolerates either build context: repository root (app in bookly/) or bookly/.
 */
$root = dirname(__DIR__);

$appRoot = is_file($root.'/bookly/index.php') ? $root.'/bookly' : $root;

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Real static files are served by the built-in server directly.
foreach ([$root.'/public'.$path, $appRoot.'/public'.$path] as $candidate) {
    if ($path !== '/' && is_file($candidate)) {
        return false;
    }
}

// Prioritize the main index.php over the front controller to avoid infinite loops
$bootstrap = is_file($appRoot.'/index.php')
    ? $appRoot.'/index.php'
    : $appRoot.'/public/index.php';

if (! is_file($bootstrap)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Bookly bootstrap not found. Looked for: {$bootstrap}\n";
    return true;
}

// Set BOOKLY_ROOT_PATH for the front controller before requiring it
if (! defined('BOOKLY_ROOT_PATH')) {
    define('BOOKLY_ROOT_PATH', dirname($bootstrap));
}

require $bootstrap;
return true;