<?php
declare(strict_types=1);

final class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
        }
    }

    public static function csrfToken(): string
    {
        return (string)($_SESSION['_csrf'] ?? '');
    }

    public static function verifyCsrf(?string $token): void
    {
        $expected = (string)($_SESSION['_csrf'] ?? '');
        if (!$token || !hash_equals($expected, $token)) {
            http_response_code(403);
            echo "CSRF verification failed.";
            exit;
        }
    }

    public static function flash(string $key, ?string $value = null): ?string
    {
        if ($value === null) {
            $val = $_SESSION['_flash'][$key] ?? null;
            unset($_SESSION['_flash'][$key]);
            return is_string($val) ? $val : null;
        }
        $_SESSION['_flash'][$key] = $value;
        return null;
    }
}
