<?php

namespace Bookly\Support;

use PDO;

class DB
{
    private static ?DB $instance = null;
    public PDO $pdo;
    public string $path;

    private function __construct()
    {
        $root = defined('BOOKLY_ROOT') ? BOOKLY_ROOT : (defined('BOOKLY_ROOT_PATH') ? BOOKLY_ROOT_PATH : dirname(__DIR__, 2));
        $this->path = $root.'/storage/bookly.sqlite';
        $dir = dirname($this->path);
        if (! is_dir($dir)) @mkdir($dir, 0775, true);
        $this->pdo = new PDO('sqlite:'.$this->path);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->exec('PRAGMA foreign_keys = ON');
        $this->migrate();
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

    private function migrate(): void
    {
        $schema = <<<'SQL'
CREATE TABLE IF NOT EXISTS roles (id INTEGER PRIMARY KEY, name TEXT, slug TEXT UNIQUE, description TEXT, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name TEXT, email TEXT UNIQUE, email_verified_at TEXT, password TEXT, phone TEXT, avatar TEXT, country TEXT, timezone TEXT DEFAULT 'UTC', is_active INTEGER DEFAULT 1, remember_token TEXT, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS role_user (id INTEGER PRIMARY KEY, role_id INTEGER, user_id INTEGER, UNIQUE(role_id, user_id));
CREATE TABLE IF NOT EXISTS businesses (id INTEGER PRIMARY KEY, name TEXT, slug TEXT UNIQUE, email TEXT, phone TEXT, description TEXT, address TEXT, city TEXT, state TEXT, country TEXT, postal_code TEXT, timezone TEXT DEFAULT 'UTC', currency TEXT DEFAULT 'USD', category TEXT, owner_id INTEGER, is_active INTEGER DEFAULT 1, settings TEXT, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS business_user (id INTEGER PRIMARY KEY, business_id INTEGER, user_id INTEGER, role_in_business TEXT DEFAULT 'staff', is_active INTEGER DEFAULT 1, created_at TEXT, updated_at TEXT, UNIQUE(business_id, user_id));
CREATE TABLE IF NOT EXISTS services (id INTEGER PRIMARY KEY, business_id INTEGER, name TEXT, description TEXT, duration INTEGER DEFAULT 30, price REAL DEFAULT 0, deposit REAL DEFAULT 0, category TEXT, color TEXT DEFAULT '#0071E3', image TEXT, position INTEGER DEFAULT 0, is_active INTEGER DEFAULT 1, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS clients (id INTEGER PRIMARY KEY, business_id INTEGER, user_id INTEGER, first_name TEXT, last_name TEXT, email TEXT, phone TEXT, notes TEXT, tags TEXT, is_favorite INTEGER DEFAULT 0, total_visits INTEGER DEFAULT 0, total_spent REAL DEFAULT 0, last_visit_at TEXT, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS bookings (id INTEGER PRIMARY KEY, business_id INTEGER, service_id INTEGER, staff_id INTEGER, client_id INTEGER, user_id INTEGER, start_at TEXT, end_at TEXT, status TEXT DEFAULT 'pending', price REAL DEFAULT 0, deposit REAL DEFAULT 0, tip REAL DEFAULT 0, payment_method TEXT, payment_status TEXT DEFAULT 'pending', notes TEXT, internal_notes TEXT, reminder_24h_sent INTEGER DEFAULT 0, reminder_1h_sent INTEGER DEFAULT 0, source TEXT DEFAULT 'web', created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS payments (id INTEGER PRIMARY KEY, business_id INTEGER, booking_id INTEGER, amount REAL, currency TEXT DEFAULT 'USD', method TEXT DEFAULT 'cash', status TEXT DEFAULT 'pending', transaction_id TEXT, provider TEXT, paid_at TEXT, metadata TEXT, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS reviews (id INTEGER PRIMARY KEY, business_id INTEGER, booking_id INTEGER, user_id INTEGER, rating INTEGER, comment TEXT, photos TEXT, is_approved INTEGER DEFAULT 1, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS addons (id INTEGER PRIMARY KEY, name TEXT, slug TEXT UNIQUE, description TEXT, long_description TEXT, category TEXT DEFAULT 'general', price REAL DEFAULT 0, icon TEXT, color TEXT DEFAULT '#0071E3', version TEXT DEFAULT '1.0.0', author TEXT, is_installed INTEGER DEFAULT 0, is_active INTEGER DEFAULT 0, config TEXT, screenshots TEXT, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS addon_subscriptions (id INTEGER PRIMARY KEY, addon_id INTEGER, business_id INTEGER, is_active INTEGER DEFAULT 1, starts_at TEXT, ends_at TEXT, settings TEXT, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS notifications (id INTEGER PRIMARY KEY, user_id INTEGER, business_id INTEGER, booking_id INTEGER, channel TEXT, type TEXT, subject TEXT, content TEXT, status TEXT DEFAULT 'pending', sent_at TEXT, metadata TEXT, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS installer_config (key TEXT PRIMARY KEY, value TEXT);
SQL;
        $this->pdo->exec($schema);
    }
}
