<?php

namespace Bookly\Controllers;

use Bookly\Models\User;
use Bookly\Support\DB;

class AuthController
{
    /** Max failed attempts per IP+email before a temporary lockout. */
    protected const MAX_ATTEMPTS = 5;
    protected const DECAY_SECONDS = 300;

    public static function handle(string $uri, string $method, DB $db, ?array $user): void
    {
        if ($uri === '/login' && $method === 'POST') {
            self::login($db);
        }
        if ($uri === '/logout') {
            self::logout();
        }
        if ($uri === '/login') {
            layout('auth', ['_view' => 'auth.login', 'error' => flash('error')]);
            return;
        }
    }

    protected static function login(DB $db): void
    {
        if (! csrf_check()) {
            flash('error', 'Invalid CSRF token.');
            redirect('/login');
        }

        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        $bucket = 'login:'.client_ip().':'.hash('sha256', $email);

        if ($email === '' || $password === '') {
            flash('error', 'Email and password are required.');
            redirect('/login');
        }

        if (! rate_limiter($bucket, self::MAX_ATTEMPTS, self::DECAY_SECONDS)) {
            flash('error', 'Too many attempts. Try again in a few minutes.');
            redirect('/login');
        }

        $u = User::login($db, $email, $password);

        if (! $u) {
            flash('error', 'Invalid credentials.');
            redirect('/login');
        }

        if (isset($u['is_active']) && ! (int)$u['is_active']) {
            User::logout();
            flash('error', 'This account is disabled.');
            redirect('/login');
        }

        rate_limiter_clear($bucket);
        redirect('/dashboard');
    }

    protected static function logout(): void
    {
        User::logout();
        redirect('/login');
    }
}
