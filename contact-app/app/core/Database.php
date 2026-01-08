<?php
declare(strict_types=1);

final class Database
{
    private static ?PDO $pdo = null;

    public static function pdo(): PDO
    {
        if (self::$pdo) return self::$pdo;

        $host = getenv('DB_HOST') ?: 'mysql';
        $db   = getenv('DB_NAME') ?: 'mini_mvc_apps';
        $user = getenv('DB_USER') ?: 'appuser';
        $pass = getenv('DB_PASS') ?: 'apppass';

        $dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";
        self::$pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        return self::$pdo;
    }
}
