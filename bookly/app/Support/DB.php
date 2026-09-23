<?php

namespace Bookly\Support;

use PDO;

class DB
{
    private static ?DB $instance = null;
    public PDO $pdo;
    public string $path;
    public string $driver = 'sqlite';

    private function __construct()
    {
        $root = defined('BOOKLY_ROOT') ? BOOKLY_ROOT : (defined('BOOKLY_ROOT_PATH') ? BOOKLY_ROOT_PATH : dirname(__DIR__, 2));
        $driver = getenv('DB_CONNECTION') ?: 'sqlite';
        $this->driver = $driver;

        if ($driver === 'mysql') {
            $this->pdo = new PDO(sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                getenv('DB_HOST') ?: '127.0.0.1',
                getenv('DB_PORT') ?: '3306',
                getenv('DB_DATABASE') ?: 'bookly'
            ), getenv('DB_USERNAME') ?: 'root', getenv('DB_PASSWORD') ?: '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $this->path = '';
        } else {
            $this->path = $root.'/storage/bookly.sqlite';
            $dir = dirname($this->path);
            if (! is_dir($dir)) @mkdir($dir, 0775, true);
            $this->pdo = new PDO('sqlite:'.$this->path);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->exec('PRAGMA foreign_keys = ON');
            $this->pdo->exec('PRAGMA busy_timeout = 5000');
            $this->pdo->exec('PRAGMA journal_mode = WAL');
        }

        Migrator::run($this->pdo);
    }

    public static function instance(): DB
    {
        return self::$instance ??= new self();
    }

    public function run(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function first(string $sql, array $params = []): ?array
    {
        $row = $this->run($sql, $params)->fetch();
        return $row === false ? null : $row;
    }

    public function all(string $sql, array $params = []): array
    {
        return $this->run($sql, $params)->fetchAll();
    }

    public function insert(string $table, array $data): int
    {
        $cols = array_keys($data);
        $placeholders = implode(',', array_fill(0, count($cols), '?'));
        $sql = 'INSERT INTO '.$table.' ('.implode(',', $cols).') VALUES ('.$placeholders.')';
        $this->run($sql, array_values($data));
        return (int)$this->pdo->lastInsertId();
    }

    public function update(string $table, array $data, string $where, array $params = []): int
    {
        $set = implode(',', array_map(fn ($c) => "$c = ?", array_keys($data)));
        $sql = "UPDATE $table SET $set WHERE $where";
        return $this->run($sql, array_merge(array_values($data), $params))->rowCount();
    }

    public function delete(string $table, string $where, array $params = []): int
    {
        return $this->run("DELETE FROM $table WHERE $where", $params)->rowCount();
    }
}
