<?php

namespace Bookly\Models;

use Bookly\Support\DB;

class User
{
    public static function current(DB $db): ?array
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $id = $_SESSION['user_id'] ?? null;
        if (! $id) return null;
        return $db->first('SELECT * FROM users WHERE id = ?', [$id]);
    }

    public static function login(DB $db, string $email, string $password): ?array
    {
        $u = $db->first('SELECT * FROM users WHERE email = ?', [$email]);
        if (! $u || ! password_verify($password, $u['password'])) return null;
        $_SESSION['user_id'] = $u['id'];
        return $u;
    }

    public static function logout(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        unset($_SESSION['user_id']);
        session_destroy();
    }

    public static function hasRole(array $user, string $role): bool
    {
        global $db;
        $r = $db->first('SELECT 1 FROM role_user ru JOIN roles r ON r.id = ru.role_id WHERE ru.user_id = ? AND r.slug = ?', [$user['id'], $role]);
        return (bool) $r;
    }

    public static function assignRole(DB $db, int $userId, string $slug): void
    {
        $r = $db->first('SELECT id FROM roles WHERE slug = ?', [$slug]);
        if (! $r) return;
        $db->run('INSERT OR IGNORE INTO role_user (role_id, user_id) VALUES (?, ?)', [$r['id'], $userId]);
    }
}
