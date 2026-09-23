<?php

/**
 * Bookly — container front controller (standalone, no router script).
 *
 * For hosts that point the document root straight at public/.
 */
$port = getenv('PORT') ?: '8000';

$docroot = is_dir(__DIR__.'/../bookly/public') ? __DIR__.'/../bookly/public' : __DIR__;

passthru(sprintf('php -S 0.0.0.0:%s -t %s', escapeshellarg($port), escapeshellarg($docroot)));
