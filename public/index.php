<?php

/**
 * Bookly — container front controller (used by the Docker CMD).
 *
 * Renders listen on $PORT and proxy to this process.
 */
$port = getenv('PORT') ?: '8000';
$docroot = is_dir(__DIR__.'/bookly') ? __DIR__.'/bookly/public' : __DIR__.'/public';

passthru(sprintf(
    'php -S 0.0.0.0:%s -t %s %s',
    escapeshellarg($port),
    escapeshellarg($docroot),
    escapeshellarg(__DIR__.'/router.php')
));
