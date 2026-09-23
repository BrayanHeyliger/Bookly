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
if (! function_exists('csrf_check')) {
    /**
     * Constant-time CSRF check. Accepts the token from the POST body or the
     * X-CSRF-TOKEN header (used by the fetch() calls in the UI).
     */
    function csrf_check(): bool {
        $sent = $_POST['_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
        if (! is_string($sent) || $sent === '') return false;
        return hash_equals($_SESSION['csrf'] ?? '', $sent);
    }
}
if (! function_exists('csrf_verify')) {
    /** Abort the request with 419 when the CSRF check fails. */
    function csrf_verify(): void {
        if (csrf_check()) return;
        http_response_code(419);
        header('Content-Type: text/plain; charset=utf-8');
        echo 'CSRF token mismatch. Reload the page and try again.';
        exit;
    }
}
if (! function_exists('safe_return_path')) {
    /**
     * Normalise a user-supplied return target down to a path on this host.
     *
     * Anything that is not a single-slash-prefixed path is discarded — that
     * covers "//evil.com" (protocol-relative), "https://evil.com", and
     * backslash-smuggled variants such as "/\\evil.com".
     */
    function safe_return_path(?string $candidate, string $fallback = '/'): string {
        if (! is_string($candidate) || $candidate === '') return $fallback;

        $candidate = str_replace(["\r", "\n"], '', trim($candidate));

        // Strip a scheme+host if the whole value is an absolute URL.
        if (preg_match('#^[a-z][a-z0-9+.-]*://#i', $candidate)) {
            $parts = parse_url($candidate);
            $candidate = ($parts['path'] ?? '/') . (isset($parts['query']) ? '?'.$parts['query'] : '');
        }

        if ($candidate === '' || $candidate[0] !== '/') return $fallback;
        // Reject protocol-relative ("//host") and backslash variants ("/\\host").
        if (preg_match('#^/[/\\\\]#', $candidate)) return $fallback;

        return $candidate;
    }
}
if (! function_exists('old')) {
    function old(string $key, $default = '') {
        return $_SESSION['_old'][$key] ?? $default;
    }
}
if (! function_exists('redirect')) {
    function redirect(string $url): void {
        if (! headers_sent()) {
            header('Location: ' . safe_return_path($url, '/'));
        }
        exit;
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
if (! function_exists('t')) {
    function t(string $key, array $params = []): string {
        return \Bookly\Support\Language::t($key, $params);
    }
}
if (! function_exists('lang')) {
    function lang(?string $key = null) {
        $l = \Bookly\Support\Language::current();
        return $key ? \Bookly\Support\Language::info($key) : $l;
    }
}
if (! function_exists('rate_limiter')) {
    /**
     * Small file-backed fixed-window limiter (no shared cache needed).
     *
     * usage:  if (! rate_limiter('login:'.$ip, 5, 300)) { ... too many ... }
     */
    function rate_limiter(string $key, int $maxAttempts, int $decaySeconds): bool {
        $dir = BOOKLY_ROOT.'/storage/ratelimit';
        if (! is_dir($dir)) @mkdir($dir, 0775, true);
        $file = $dir.'/'.hash('sha256', $key).'.json';
        $now = time();

        $bucket = ['count' => 0, 'reset' => $now + $decaySeconds];
        if (is_file($file)) {
            $raw = @file_get_contents($file);
            $decoded = $raw !== false ? json_decode($raw, true) : null;
            if (is_array($decoded) && isset($decoded['reset'], $decoded['count']) && $decoded['reset'] > $now) {
                $bucket = ['count' => (int)$decoded['count'], 'reset' => (int)$decoded['reset']];
            }
        }

        $bucket['count']++;
        @file_put_contents($file, json_encode($bucket), LOCK_EX);

        return $bucket['count'] <= $maxAttempts;
    }
}
if (! function_exists('rate_limiter_clear')) {
    function rate_limiter_clear(string $key): void {
        $file = BOOKLY_ROOT.'/storage/ratelimit/'.hash('sha256', $key).'.json';
        if (is_file($file)) @unlink($file);
    }
}
if (! function_exists('client_ip')) {
    function client_ip(): string {
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
}
