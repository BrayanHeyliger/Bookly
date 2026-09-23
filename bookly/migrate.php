<?php
/**
 * Bookly CLI migrator.
 *
 *   php migrate.php          apply every pending migration
 *   php migrate.php status   show applied versions
 */
if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "migrate.php must be run from the command line.\n");
    exit(1);
}

require __DIR__.'/bootstrap.php';

$pdo = Bookly\Support\DB::instance()->pdo;

if (($argv[1] ?? '') === 'status') {
    $applied = Bookly\Support\Migrator::applied($pdo);
    echo "Applied migrations:\n";
    if (! $applied) { echo "  (none)\n"; exit(0); }
    foreach ($applied as $row) {
        echo '  v'.$row['version'].'  '.$row['applied_at']."\n";
    }
    exit(0);
}

$before = count(Bookly\Support\Migrator::applied($pdo));
Bookly\Support\Migrator::run($pdo);
$after = count(Bookly\Support\Migrator::applied($pdo));

echo $after > $before
    ? 'OK: applied '.($after - $before)." migration(s).\n"
    : "OK: nothing to migrate, schema is up to date.\n";
