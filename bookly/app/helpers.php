<?php

if (! function_exists('e')) {
    function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
}
if (! function_exists('url')) {
    function url(string $path = '/'): string { return $path; }
}
if (! function_exists('view')) {
    function view(string $name, array $data = []): void {
        $file = BOOKLY_ROOT.'/resources/views/'.$name.'.php';
        if (! is_file($file)) { http_response_code(500); echo "View not found: $name"; return; }
        extract($data, EXTR_SKIP);
        require $file;
    }
}
if (! function_exists('layout')) {
    function layout(string $name, array $data = []): void {
        $__data = $data;
        $__view = isset($data['_view']) ? str_replace('.', '/', $data['_view']) : '';
        $__use_data = $data;
        $file = BOOKLY_ROOT.'/resources/layouts/'.$name.'.php';
        if (is_file($file)) require $file;
        else echo "Layout not found: ".htmlspecialchars($name);
    }
}
if (! function_exists('csrf_token')) {
    function csrf_token(): string {
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['csrf'];
    }
}
if (! function_exists('csrf_field')) {
    function csrf_field(): string {
        return '<input type="hidden" name="_token" value="'.csrf_token().'">';
    }
}
if (! function_exists('old')) {
    function old(string $key, $default = '') {
        return $_SESSION['_old'][$key] ?? $default;
    }
}
if (! function_exists('redirect')) {
    function redirect(string $url): void {
        header('Location: '.$url); exit;
    }
}
if (! function_exists('config')) {
    function config(string $key, $default = null) {
        static $cfg = null;
        if ($cfg === null) {
            $cfg = require BOOKLY_ROOT.'/config/app.php';
        }
        $parts = explode('.', $key);
        foreach ($parts as $p) {
            $cfg = is_array($cfg) ? ($cfg[$p] ?? null) : ($cfg->$p ?? null);
            if ($cfg === null) return $default;
        }
        return $cfg ?? $default;
    }
}
if (! function_exists('now')) {
    function now() { return date('Y-m-d H:i:s'); }
}
if (! function_exists('session')) {
    function session(?string $key = null, $value = null) {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if ($key === null) return $_SESSION;
        if (func_num_args() === 1) return $_SESSION[$key] ?? null;
        $_SESSION[$key] = $value;
        return $value;
    }
}
if (! function_exists('flash')) {
    function flash(?string $key = null, ?string $value = null) {
        if ($key !== null && $value !== null) { $_SESSION['_flash'][$key] = $value; return; }
        if ($key !== null) {
            $v = $_SESSION['_flash'][$key] ?? null;
            unset($_SESSION['_flash'][$key]);
            return $v;
        }
    }
}
if (! function_exists('asset')) {
    function asset(string $path): string { return '/assets/'.ltrim($path, '/'); }
}
