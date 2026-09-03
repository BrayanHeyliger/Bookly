<?php

namespace Bookly\Controllers;

use Bookly\Models\User;
use Bookly\Support\DB;

class AuthController
{
    public static function handle(string $uri, string $method, DB $db, ?array $user): void
    {
        if ($uri === '/login' && $method === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            if (! hash_equals($_SESSION['csrf'] ?? '', $_POST['_token'] ?? '')) {
                flash('error', 'Invalid CSRF token.');
                redirect('/login');
            }
            $u = User::login($db, $email, $password);
            if (! $u) {
                flash('error', 'Invalid credentials.');
                redirect('/login');
            }
            redirect('/dashboard');
        }
        if ($uri === '/logout') {
            User::logout();
            redirect('/login');
        }
        if ($uri === '/login') {
            layout('auth', ['_view' => 'auth.login', 'error' => flash('error')]);
            return;
        }
    }
}
