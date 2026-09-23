<?php
/**
 * Bookly CLI — supports the addon:install command.
 *
 *   php artisan.php addon:install whatsapp
 *   php artisan.php addon:uninstall giftcards
 *   php artisan.php addon:list
 */
if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "artisan.php must be run from the command line.\n");
    exit(1);
}

require __DIR__.'/bootstrap.php';

$db = Bookly\Support\DB::instance();
$addons = Bookly\Support\AddonManager::instance($db);

$argv = $_SERVER['argv'] ?? [];
array_shift($argv);
$cmd = $argv[0] ?? 'help';

switch ($cmd) {
    case 'addon:install':
        $slug = $argv[1] ?? null;
        if (! $slug) { echo "Usage: php artisan.php addon:install {slug}\n"; exit(1); }
        if (! $addons->exists($slug)) { echo "✖ Unknown addon '{$slug}'.\n"; exit(1); }
        $addons->install($slug);
        echo "✔ Installed '{$slug}'.\n";
        break;
    case 'addon:uninstall':
        $slug = $argv[1] ?? null;
        if (! $slug) { echo "Usage: php artisan.php addon:uninstall {slug}\n"; exit(1); }
        if (! $addons->exists($slug)) { echo "✖ Unknown addon '{$slug}'.\n"; exit(1); }
        $addons->uninstall($slug);
        echo "✔ Uninstalled '{$slug}'.\n";
        break;
    case 'addon:list':
        foreach ($addons->all() as $a) {
            $status = $a['is_installed'] ? ($a['is_active'] ? '✓ active' : '◯ installed') : '· not installed';
            echo str_pad($a['slug'], 22) . str_pad($a['name'], 28) . $status . "\n";
        }
        break;
    case 'help':
    default:
        echo "Bookly CLI\n";
        echo "  php artisan.php addon:install {slug}\n";
        echo "  php artisan.php addon:uninstall {slug}\n";
        echo "  php artisan.php addon:list\n";
}
