<?php

namespace Bookly\Controllers;

use Bookly\Support\DB;

class InstallerController
{
    /** Minimum length for the first administrator password. */
    protected const MIN_PASSWORD_LENGTH = 12;

    /** Passwords that must never survive installation. */
    protected const WEAK_PASSWORDS = [
        'password', 'password123', '123456', '12345678', '123456789', '1234567890',
        'admin', 'admin123', 'administrator', 'qwerty', 'letmein', 'welcome',
        'bookly', 'changeme', 'secret', 'root', 'test', 'demo', 'abc123',
    ];

    public static function handle(string $uri, string $method, DB $db): void
    {
        if ($uri === '/install' || $uri === '/install/') {
            self::welcome();
            return;
        }
        if ($uri === '/install/requirements') { self::requirements(); return; }
        if ($uri === '/install/database')     { self::database($db, $method); return; }
        if ($uri === '/install/admin')        { self::admin(); return; }
        if ($uri === '/install/finish')       { self::finish($db); return; }
        if ($uri === '/install/test-db' && $method === 'POST') { self::testDb(); return; }
        http_response_code(404); echo 'Not found';
    }

    protected static function steps(int $current = 0): array
    {
        return [
            ['name' => 'Welcome',     'route' => '/install',             'index' => 0],
            ['name' => 'Requirements','route' => '/install/requirements','index' => 1],
            ['name' => 'Database',    'route' => '/install/database',    'index' => 2],
            ['name' => 'Admin',       'route' => '/install/admin',       'index' => 3],
            ['name' => 'Finish',      'route' => '/install/finish',      'index' => 4],
        ];
    }

    protected static function render(string $view, array $data = []): void
    {
        $data['_view'] = 'installer.'.$view;
        $data['__current_step'] = $data['__current_step'] ?? 0;
        $data['__steps'] = self::steps($data['__current_step']);
        layout('installer', $data);
    }

    public static function welcome(): void
    {
        self::render('welcome', ['__current_step' => 0]);
    }

    public static function requirements(): void
    {
        $checks = [
            ['name' => 'PHP >= 8.1',           'ok' => version_compare(PHP_VERSION, '8.1.0', '>='), 'detail' => PHP_VERSION],
            ['name' => 'PDO extension',        'ok' => extension_loaded('pdo'),         'detail' => 'pdo'],
            ['name' => 'PDO SQLite driver',    'ok' => extension_loaded('pdo_sqlite'),  'detail' => 'pdo_sqlite'],
            ['name' => 'mbstring extension',   'ok' => extension_loaded('mbstring'),    'detail' => 'mbstring'],
            ['name' => 'storage/ writable',    'ok' => is_writable(BOOKLY_ROOT.'/storage'), 'detail' => 'storage'],
            ['name' => 'database/ writable',   'ok' => is_writable(BOOKLY_ROOT.'/database'), 'detail' => 'database'],
        ];
        $allOk = array_reduce($checks, fn($c, $i) => $c && $i['ok'], true);
        self::render('requirements', ['__current_step' => 1, 'checks' => $checks, 'allOk' => $allOk]);
    }

    public static function database(DB $db, string $method): void
    {
        if ($method === 'POST') {
            $data = $_POST;
            $db->update('installer_config', ['value' => 'sqlite'], 'key = ?', ['db_driver']);
            foreach (['db_name','admin_name','admin_email','admin_password','business_name','country','timezone'] as $k) {
                if (isset($data[$k])) $db->update('installer_config', ['value' => $data[$k]], 'key = ?', [$k]);
            }
            redirect('/install/admin');
        }
        self::render('database', ['__current_step' => 2]);
    }

    public static function admin(): void
    {
        self::render('admin', ['__current_step' => 3, 'error' => flash('error')]);
    }

    public static function testDb(): void
    {
        header('Content-Type: application/json');
        try {
            $path = BOOKLY_ROOT.'/storage/bookly.sqlite';
            $pdo = new \PDO('sqlite:'.$path);
            $pdo->query('SELECT 1');
            echo json_encode(['ok' => true, 'message' => 'Connection successful.']);
        } catch (\Throwable $e) {
            // Do not echo driver internals back to the browser.
            echo json_encode(['ok' => false, 'message' => 'Connection failed.']);
        }
    }

    /**
     * Validate the credentials submitted in the last installer step.
     *
     * @return array{ok: bool, errors: array<string>, admin: array<string, string>}
     */
    public static function validateAdmin(array $input): array
    {
        $name = trim((string)($input['name'] ?? ''));
        $email = strtolower(trim((string)($input['email'] ?? '')));
        $password = (string)($input['password'] ?? '');
        $confirm = (string)($input['password_confirmation'] ?? $input['password_confirm'] ?? '');
        $business = trim((string)($input['business_name'] ?? ''));

        $errors = [];

        if ($name === '') {
            $errors[] = 'Your name is required.';
        }
        if ($email === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid email address is required.';
        }
        if ($business === '') {
            $errors[] = 'A business name is required.';
        }
        if (mb_strlen($password) < self::MIN_PASSWORD_LENGTH) {
            $errors[] = 'The password must be at least '.self::MIN_PASSWORD_LENGTH.' characters long.';
        }
        if (in_array(strtolower($password), self::WEAK_PASSWORDS, true)) {
            $errors[] = 'That password is too common. Choose something else.';
        }
        if (preg_match('/[a-z]/', $password) !== 1
            || preg_match('/[A-Z]/', $password) !== 1
            || preg_match('/[0-9]/', $password) !== 1) {
            $errors[] = 'The password must mix upper-case, lower-case and numbers.';
        }
        $localPart = $email !== '' ? explode('@', $email)[0] : '';
        if (strlen($localPart) >= 3 && stripos($password, $localPart) !== false) {
            $errors[] = 'The password must not contain your email address.';
        }
        if ($confirm !== '' && ! hash_equals($password, $confirm)) {
            $errors[] = 'The password confirmation does not match.';
        }

        return [
            'ok' => $errors === [],
            'errors' => $errors,
            'admin' => [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'business_name' => $business !== '' ? $business : 'My Bookly',
                'country' => trim((string)($input['country'] ?? 'US')) ?: 'US',
                'timezone' => trim((string)($input['timezone'] ?? 'UTC')) ?: 'UTC',
            ],
        ];
    }

    public static function finish(DB $db): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (! csrf_check()) {
                flash('error', 'Invalid CSRF token. Reload the page and try again.');
                redirect('/install/finish');
            }

            $validation = self::validateAdmin($_POST);

            if (! $validation['ok']) {
                flash('error', implode(' ', $validation['errors']));
                redirect('/install/finish');
            }

            $admin = $validation['admin'];

            try {
                foreach (['superadmin' => 'Super Admin','owner' => 'Owner','manager' => 'Manager','staff' => 'Staff','client' => 'Client'] as $slug => $name) {
                    $db->run('INSERT OR IGNORE INTO roles (name, slug, description, created_at, updated_at) VALUES (?, ?, ?, ?, ?)',
                        [$name, $slug, '', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
                }

                $now = date('Y-m-d H:i:s');
                $db->run('INSERT OR IGNORE INTO users (name, email, password, country, timezone, email_verified_at, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?)',
                    [$admin['name'], $admin['email'], password_hash($admin['password'], PASSWORD_BCRYPT), $admin['country'], $admin['timezone'], $now, $now, $now]);
                $u = $db->first('SELECT * FROM users WHERE email = ?', [$admin['email']]);

                $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $admin['business_name']));
                if (! $slug) $slug = 'bookly';
                $db->run('INSERT INTO businesses (name, slug, email, country, timezone, currency, category, owner_id, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?)',
                    [$admin['business_name'], $slug, $admin['email'], $admin['country'], $admin['timezone'], 'USD', 'Barbershop', $u['id'], $now, $now]);
                $b = $db->first('SELECT * FROM businesses WHERE slug = ?', [$slug]);
                $db->run('INSERT INTO business_user (business_id, user_id, role_in_business, is_active, created_at, updated_at) VALUES (?, ?, ?, 1, ?, ?)',
                    [$b['id'], $u['id'], 'owner', $now, $now]);

                $r = $db->first('SELECT id FROM roles WHERE slug = ?', ['superadmin']);
                $db->run('INSERT OR IGNORE INTO role_user (role_id, user_id) VALUES (?, ?)', [$r['id'], $u['id']]);

                $services = [['Haircut',30,35,'Grooming'],['Beard Trim',20,18,'Grooming'],['Hair Color',75,90,'Color'],['Shave & Style',45,50,'Grooming'],['Kids Cut',25,22,'Kids']];
                foreach ($services as $i => [$name,$dur,$price,$cat]) {
                    $db->run('INSERT INTO services (business_id, name, duration, price, deposit, category, color, position, is_active, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,1,?,?)',
                        [$b['id'], $name, $dur, $price, 5, $cat, '#0071E3', $i, $now, $now]);
                }

                // Demo staff — no sign-in credentials: these rows exist only to be
                // assigned bookings and cannot be logged into (unknowable password).
                $staff = [['Alex Stone','alex@bookly.app'],['Jamie Lee','jamie@bookly.app'],['Rita Vance','rita@bookly.app']];
                $staffIds = [];
                foreach ($staff as [$name, $email]) {
                    $db->run('INSERT OR IGNORE INTO users (name, email, password, email_verified_at, is_active, created_at, updated_at) VALUES (?,?,?,?,1,?,?)',
                        [$name, $email, password_hash(bin2hex(random_bytes(32)), PASSWORD_BCRYPT), $now, $now, $now]);
                    $su = $db->first('SELECT id FROM users WHERE email = ?', [$email]);
                    $staffIds[] = $su['id'];
                    $rStaff = $db->first('SELECT id FROM roles WHERE slug = ?', ['staff']);
                    $db->run('INSERT OR IGNORE INTO role_user (role_id, user_id) VALUES (?, ?)', [$rStaff['id'], $su['id']]);
                    $db->run('INSERT OR IGNORE INTO business_user (business_id, user_id, role_in_business, is_active, created_at, updated_at) VALUES (?,?,?,1,?,?)',
                        [$b['id'], $su['id'], 'staff', $now, $now]);
                }

                $serviceRows = $db->all('SELECT * FROM services WHERE business_id = ?', [$b['id']]);
                for ($i = 1; $i <= 8; $i++) {
                    $db->run('INSERT INTO clients (business_id, first_name, last_name, email, phone, is_favorite, total_visits, total_spent, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?)',
                        [$b['id'], 'Client', "#{$i}", "client{$i}@example.com", "+1 555 000{$i}", $i % 3 === 0 ? 1 : 0, rand(1, 12), rand(50, 600), $now, $now]);
                }
                $clientRows = $db->all('SELECT * FROM clients WHERE business_id = ?', [$b['id']]);
                for ($d = -14; $d <= 7; $d++) {
                    for ($i = 0; $i < rand(0, 4); $i++) {
                        $svc = $serviceRows[array_rand($serviceRows)];
                        $staff = $staffIds[array_rand($staffIds)];
                        $client = $clientRows[array_rand($clientRows)];
                        $ts = mktime(rand(9, 19), 0, 0, (int)date('n'), (int)date('j') + $d, (int)date('Y'));
                        $start = date('Y-m-d H:i:s', $ts);
                        $end = date('Y-m-d H:i:s', $ts + $svc['duration'] * 60);
                        $status = $d < 0 ? 'completed' : 'confirmed';
                        $db->run('INSERT INTO bookings (business_id, service_id, staff_id, client_id, start_at, end_at, status, price, deposit, payment_method, payment_status, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)',
                            [$b['id'], $svc['id'], $staff, $client['id'], $start, $end, $status, $svc['price'], $svc['deposit'], 'cash', $status === 'completed' ? 'paid' : 'pending', $now, $now]);
                    }
                }

                $completed = $db->all('SELECT * FROM bookings WHERE business_id = ? AND status = ? LIMIT 10', [$b['id'], 'completed']);
                foreach ($completed as $bk) {
                    $db->run('INSERT OR IGNORE INTO reviews (business_id, booking_id, rating, comment, is_approved, created_at, updated_at) VALUES (?,?,?,?,1,?,?)',
                        [$b['id'], $bk['id'], rand(4, 5), 'Great experience!', $now, $now]);
                }

                @mkdir(BOOKLY_ROOT.'/storage', 0775, true);
                file_put_contents(BOOKLY_ROOT.'/storage/installed.lock', date('c'));

                if (session_status() !== PHP_SESSION_ACTIVE) session_start();
                session_regenerate_id(true);
                $_SESSION['user_id'] = $u['id'];
                redirect('/dashboard');
            } catch (\Throwable $e) {
                // Log the detail, show the user nothing that leaks internals.
                error_log('[Bookly] install failed: '.$e->getMessage());
                flash('error', 'Install failed. Check the server log for details.');
                redirect('/install/finish');
            }
            return;
        }
        self::render('finish', ['__current_step' => 4, 'error' => flash('error')]);
    }
}
