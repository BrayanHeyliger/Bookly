<?php
/**
 * Bookly — Self-contained single-file application.
 *
 * This is a complete, working demo of the Bookly SaaS booking platform:
 *  - 5-step Installer Wizard (Apple-style)
 *  - Multi-role auth (Superadmin, Owner, Manager, Staff, Client)
 *  - Dashboard with KPIs and Chart.js
 *  - Calendar (week view), Bookings, Services, Clients, Reviews, Reports
 *  - Public booking page (/book/{slug})
 *  - Addon Marketplace (10 addons, installable from UI or CLI)
 *  - SQLite-backed persistence
 *
 * Run:  php -S 0.0.0.0:8000 -t public
 * Then open http://localhost:8000
 */

(function () {
    define('BOOKLY_START', microtime(true));
    $root = defined('BOOKLY_ROOT_PATH') ? BOOKLY_ROOT_PATH : (function () {
        $d = __DIR__;
        return is_file($d.'/index.php') && is_dir($d.'/app') ? $d : dirname($d);
    })();
    define('BOOKLY_ROOT', $root);

    spl_autoload_register(function ($class) {
        if (str_starts_with($class, 'Bookly\\')) {
            $rel = str_replace('\\', '/', substr($class, 7));
            foreach (['app/'.$rel, $rel] as $candidate) {
                $file = BOOKLY_ROOT.'/'.$candidate.'.php';
                if (is_file($file)) { require $file; return; }
            }
        }
    });

    require BOOKLY_ROOT.'/app/helpers.php';

    Bookly\Support\Language::init();

    $db = Bookly\Support\DB::instance();
    $addons = Bookly\Support\AddonManager::instance($db);
    $user = Bookly\Models\User::current($db);
    $installed = file_exists(BOOKLY_ROOT.'/storage/installed.lock');

    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    if (preg_match('#^/lang/([a-z]{2})$#', $uri, $m)) {
        Bookly\Support\Language::set($m[1]);
        $back = $_SERVER['HTTP_REFERER'] ?? '/';
        if (! str_starts_with($back, '/')) $back = '/';
        header('Location: ' . $back); exit;
    }

    if (! $installed && ! str_starts_with($uri, '/install')) {
        header('Location: /install'); exit;
    }
    if ($installed && str_starts_with($uri, '/install') && $uri !== '/install/finish') {
        header('Location: /dashboard'); exit;
    }

    if (str_starts_with($uri, '/install'))  return Bookly\Controllers\InstallerController::handle($uri, $method, $db);
    if (str_starts_with($uri, '/api/'))     return Bookly\Controllers\ApiController::handle($uri, $method, $db, $addons);
    if (str_starts_with($uri, '/book/'))    return Bookly\Controllers\PublicBookingController::handle($uri, $method, $db);
    if (str_starts_with($uri, '/explore') || str_starts_with($uri, '/category') || str_starts_with($uri, '/city') || str_starts_with($uri, '/business') || $uri === '/search') return Bookly\Controllers\MarketplaceController::handle($uri, $method, $db);

    if (in_array($uri, ['/login', '/logout'], true)) {
        return Bookly\Controllers\AuthController::handle($uri, $method, $db, $user);
    }

    if (! $installed) { header('Location: /install'); exit; }

    // Public marketing landing — show to anonymous visitors, redirect logged-in users to dashboard
    if ($uri === '/' || $uri === '/features' || $uri === '/pricing' || $uri === '/addons') {
        if ($user) { header('Location: /dashboard'); exit; }
        $landingFile = BOOKLY_ROOT.'/resources/views/marketing/landing.php';
        if (is_file($landingFile)) require $landingFile;
        exit;
    }

    if (! $user) { header('Location: /login'); exit; }

    return Bookly\Controllers\AppController::handle($uri, $method, $db, $user, $addons);
})();
