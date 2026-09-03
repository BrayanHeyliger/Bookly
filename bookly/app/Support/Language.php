<?php
namespace Bookly\Support;

class Language
{
    private static array $supported = [];
    private static array $translations = [];
    private static string $current = 'en';
    private static ?string $detectedCountry = null;

    public static function init(): void
    {
        if (! empty(self::$supported)) return;
        self::$supported = require BOOKLY_ROOT . '/config/languages.php';
        self::$current = self::detect();
        self::load(self::$current);
    }

    public static function supported(): array
    {
        if (empty(self::$supported)) self::init();
        return self::$supported;
    }

    public static function current(): string
    {
        if (empty(self::$supported)) self::init();
        return self::$current;
    }

    public static function info(?string $code = null): array
    {
        if (empty(self::$supported)) self::init();
        $code = $code ?? self::$current;
        return self::$supported[$code] ?? self::$supported['en'];
    }

    public static function dir(): string { return self::info()['dir']; }

    public static function set(string $code): void
    {
        $code = substr($code, 0, 2);
        if (! isset(self::$supported[$code])) return;
        self::$current = $code;
        self::load($code);
        setcookie('bookly_lang', $code, [
            'expires'  => time() + 60 * 60 * 24 * 365,
            'path'     => '/',
            'samesite' => 'Lax',
            'secure'   => ! empty($_SERVER['HTTPS']),
        ]);
    }

    public static function detectedCountry(): ?string { return self::$detectedCountry; }

    private static function detect(): string
    {
        if (! empty($_COOKIE['bookly_lang']) && isset(self::$supported[$_COOKIE['bookly_lang']])) {
            return $_COOKIE['bookly_lang'];
        }
        if (! empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $al = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            foreach (explode(',', $al) as $part) {
                $code = substr(trim(explode(';', $part)[0]), 0, 2);
                if (isset(self::$supported[$code])) return $code;
            }
        }
        $country = self::detectCountryFromIp();
        if ($country) {
            $map = [
                'US' => 'en', 'GB' => 'en', 'CA' => 'en', 'AU' => 'en', 'IE' => 'en', 'NZ' => 'en',
                'ES' => 'es', 'MX' => 'es', 'AR' => 'es', 'CO' => 'es', 'CL' => 'es', 'PE' => 'es', 'VE' => 'es', 'UY' => 'es',
                'BR' => 'pt', 'PT' => 'pt', 'AO' => 'pt', 'MZ' => 'pt',
                'FR' => 'fr', 'BE' => 'fr', 'CH' => 'fr', 'LU' => 'fr',
                'DE' => 'de', 'AT' => 'de',
                'IT' => 'it',
                'SA' => 'ar', 'AE' => 'ar', 'EG' => 'ar', 'MA' => 'ar', 'DZ' => 'ar', 'TN' => 'ar', 'LY' => 'ar', 'JO' => 'ar', 'LB' => 'ar', 'KW' => 'ar', 'QA' => 'ar', 'OM' => 'ar', 'BH' => 'ar', 'IQ' => 'ar', 'YE' => 'ar', 'SY' => 'ar',
                'CN' => 'zh', 'HK' => 'zh', 'TW' => 'zh', 'SG' => 'zh',
            ];
            if (isset($map[$country])) return $map[$country];
        }
        return 'en';
    }

    private static function detectCountryFromIp(): ?string
    {
        $ip = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? $_SERVER['HTTP_X_COUNTRY_CODE'] ?? null;
        if ($ip && strlen($ip) === 2) {
            self::$detectedCountry = strtoupper($ip);
            return self::$detectedCountry;
        }
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? null;
        if (! $ip) return null;
        $ip = trim(explode(',', $ip)[0]);
        if (! filter_var($ip, FILTER_VALIDATE_IP)) return null;
        $cache = BOOKLY_ROOT . '/storage/cache';
        if (! is_dir($cache)) @mkdir($cache, 0775, true);
        $key = substr(md5($ip), 0, 16);
        $file = "$cache/geo_$key.json";
        if (is_file($file) && time() - filemtime($file) < 86400 * 7) {
            $data = json_decode((string) file_get_contents($file), true);
            if (! empty($data['country'])) { self::$detectedCountry = $data['country']; return $data['country']; }
        }
        $ctx = stream_context_create(['http' => ['timeout' => 1.5, 'ignore_errors' => true]]);
        $resp = @file_get_contents("https://ipapi.co/{$ip}/country/", false, $ctx);
        if ($resp && strlen($resp) === 2) {
            $country = strtoupper(trim($resp));
            @file_put_contents($file, json_encode(['country' => $country, 'ip' => $ip, 'ts' => time()]));
            self::$detectedCountry = $country;
            return $country;
        }
        return null;
    }

    private static function load(string $code): void
    {
        $file = BOOKLY_ROOT . "/resources/lang/{$code}.php";
        self::$translations[$code] = is_file($file)
            ? require $file
            : require BOOKLY_ROOT . '/resources/lang/en.php';
    }

    public static function t(string $key, array $params = []): string
    {
        if (empty(self::$supported)) self::init();
        $dict = self::$translations[self::$current] ?? [];
        $value = $dict[$key] ?? ($self::$translations['en'][$key] ?? $key);
        if (! empty($params)) {
            foreach ($params as $k => $v) $value = str_replace(':' . $k, (string) $v, $value);
        }
        return $value;
    }
}
