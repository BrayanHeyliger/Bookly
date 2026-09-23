<?php

namespace Bookly\Support;

/**
 * Versioned schema migrations. Never edit an applied migration; append a new one.
 */
class Migrator
{
    public static function migrations(): array
    {
        return [
            1 => <<<'SQL'
CREATE TABLE IF NOT EXISTS schema_migrations (version INTEGER PRIMARY KEY, applied_at TEXT);
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
CREATE TABLE IF NOT EXISTS business_hours (id INTEGER PRIMARY KEY, business_id INTEGER, day TEXT, open TEXT DEFAULT '09:00', close TEXT DEFAULT '18:00', is_closed INTEGER DEFAULT 0, created_at TEXT, updated_at TEXT);
CREATE TABLE IF NOT EXISTS blog_posts (id INTEGER PRIMARY KEY, title TEXT, slug TEXT UNIQUE, excerpt TEXT, content TEXT, is_published INTEGER DEFAULT 0, created_at TEXT, updated_at TEXT);
SQL,

            2 => <<<'SQL'
CREATE INDEX IF NOT EXISTS idx_bookings_business_start ON bookings (business_id, start_at);
CREATE INDEX IF NOT EXISTS idx_bookings_status ON bookings (business_id, status);
CREATE INDEX IF NOT EXISTS idx_services_business ON services (business_id, position);
CREATE INDEX IF NOT EXISTS idx_clients_business ON clients (business_id, created_at);
CREATE INDEX IF NOT EXISTS idx_payments_booking ON payments (booking_id);
CREATE INDEX IF NOT EXISTS idx_notifications_user ON notifications (user_id, created_at);
CREATE INDEX IF NOT EXISTS idx_role_user_user ON role_user (user_id);
CREATE INDEX IF NOT EXISTS idx_users_email ON users (email);
SQL,

            3 => <<<'SQL'
CREATE INDEX IF NOT EXISTS idx_business_user_user ON business_user (user_id, business_id);
SQL,
        ];
    }

    public static function run(\PDO $pdo): void
    {
        $pdo->exec('CREATE TABLE IF NOT EXISTS schema_migrations (version INTEGER PRIMARY KEY, applied_at TEXT)');

        $applied = $pdo->query('SELECT version FROM schema_migrations')->fetchAll(\PDO::FETCH_COLUMN);
        $applied = array_map('intval', $applied ?: []);

        foreach (self::migrations() as $version => $sql) {
            if (in_array((int)$version, $applied, true)) continue;
            foreach (self::split($sql) as $statement) {
                $pdo->exec($statement);
            }
            $stmt = $pdo->prepare('INSERT INTO schema_migrations (version, applied_at) VALUES (?, ?)');
            $stmt->execute([(int)$version, date('Y-m-d H:i:s')]);
        }
    }

    public static function applied(\PDO $pdo): array
    {
        $rows = $pdo->query('SELECT version, applied_at FROM schema_migrations ORDER BY version')->fetchAll(\PDO::FETCH_ASSOC);
        return $rows ?: [];
    }

    protected static function split(string $sql): array
    {
        $statements = [];
        foreach (preg_split('/;\s*\n/', $sql) as $chunk) {
            $chunk = trim((string)preg_replace('/^\s*--.*$/m', '', $chunk));
            if ($chunk !== '') $statements[] = $chunk;
        }
        return $statements;
    }
}
