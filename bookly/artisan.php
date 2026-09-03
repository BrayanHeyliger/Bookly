<?php
/**
 * Bookly CLI — supports the addon:install command.
 *
 *   php artisan.php addon:install whatsapp
 *   php artisan.php addon:uninstall giftcards
 *   php artisan.php addon:list
 */
define('BOOKLY_START', microtime(true));
define('BOOKLY_ROOT', dirname(__DIR__));

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

$db = Bookly\Support\DB::instance();
$addons = Bookly\Support\AddonManager::instance($db);

$argv = $_SERVER['argv'];
array_shift($argv);
$cmd = $argv[0] ?? 'help';

switch ($cmd) {
    case 'addon:install':
        $slug = $argv[1] ?? null;
        if (! $slug) { echo "Usage: php artisan.php addon:install {slug}\n"; exit(1); }
        $addons->install($slug);
        echo "✔ Installed '{$slug}'.\n";
        break;
    case 'addon:uninstall':
        $slug = $argv[1] ?? null;
        if (! $slug) { echo "Usage: php artisan.php addon:uninstall {slug}\n"; exit(1); }
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
