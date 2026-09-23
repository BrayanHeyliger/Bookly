<?php

/**
 * Bookly — front controller for container deployments.
 *
 * Render listens on $PORT and proxies to this process.
 */
$port = getenv('PORT') ?: '8000';
$docroot = is_dir(__DIR__.'/bookly') ? __DIR__.'/bookly' : __DIR__;

passthru(sprintf('php -S 0.0.0.0:%s -t %s', $port, escapeshellarg($docroot)));
