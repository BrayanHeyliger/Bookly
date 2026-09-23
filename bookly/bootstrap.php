<?php

/**
 * Bookly — vendor-free autoload bootstrap shared by artisan.php.
 *
 * Defines BOOKLY_ROOT (the directory holding app/, config/ and resources/)
 * and registers the `Bookly\` namespace autoloader.
 */

if (! defined('BOOKLY_ROOT')) {
    define('BOOKLY_ROOT', dirname(__DIR__));
}

if (! defined('BOOKLY_START')) {
    define('BOOKLY_START', microtime(true));
}

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
