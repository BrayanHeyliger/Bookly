<?php

namespace Bookly\Support;

/**
 * Route-level authorisation.
 */
class Authorizer
{
    public const ANY = null;

    protected const ROUTE_ROLES = [
        '/admin/'        => 'superadmin',
        '/settings'      => 'manager',
        '/hours'         => 'manager',
        '/reports'       => 'manager',
        '/staff'         => 'manager',
        '/services'      => 'manager',
        '/addons'        => 'owner',
        '/notifications' => 'manager',
        '/profile'       => 'staff',
    ];

    protected const WEIGHTS = [
        'superadmin' => 50,
        'owner'      => 40,
        'manager'    => 30,
        'staff'      => 20,
        'client'     => 10,
    ];

    public static function roleFor(string $uri): ?string
    {
        foreach (self::ROUTE_ROLES as $prefix => $role) {
            if (str_starts_with($uri, $prefix)) return $role;
        }
        return self::ANY;
    }

    public static function businessRole(DB $db, ?array $user): ?string
    {
        if (! $user) return null;
        $row = $db->first(
            'SELECT role_in_business FROM business_user WHERE user_id = ? ORDER BY id LIMIT 1',
            [$user['id']]
        );
        return $row['role_in_business'] ?? null;
    }

    public static function weight(string $role): int
    {
        return self::WEIGHTS[$role] ?? 0;
    }

    public static function effectiveRole(DB $db, array $user): ?string
    {
        $best = self::businessRole($db, $user);

        $rows = $db->all(
            'SELECT r.slug FROM role_user ru JOIN roles r ON r.id = ru.role_id WHERE ru.user_id = ?',
            [$user['id']]
        );
        foreach ($rows as $row) {
            if (self::weight($row['slug']) > self::weight((string)$best)) {
                $best = $row['slug'];
            }
        }

        return $best;
    }

    public static function allows(DB $db, ?array $user, ?string $required): bool
    {
        if (! $user) return false;
        if ($required === null) return true;

        $effective = self::effectiveRole($db, $user);
        if ($effective === null) return false;
        if ($effective === 'superadmin') return true;

        return self::weight($effective) >= self::weight($required);
    }

    public static function guard(DB $db, ?array $user, string $uri): void
    {
        if (self::allows($db, $user, self::roleFor($uri))) return;

        http_response_code(403);
        if ($user) {
            layout('app', [
                '_view' => 'errors.forbidden',
                'title' => 'Forbidden',
                'user' => $user,
                'required' => self::roleFor($uri),
            ]);
        } else {
            redirect('/login');
        }
        exit;
    }
}
