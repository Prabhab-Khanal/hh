<?php
declare(strict_types=1);

final class User
{
    public function create(string $email, string $password): void
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = Database::pdo()->prepare("INSERT INTO users (email, password_hash) VALUES (:email, :hash)");
        $stmt->execute(['email' => $email, 'hash' => $hash]);
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = Database::pdo()->prepare("SELECT id, email, password_hash FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = Database::pdo()->prepare("SELECT id, email, created_at FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
