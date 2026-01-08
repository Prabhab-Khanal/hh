<?php
declare(strict_types=1);

final class Contact
{
    public function create(string $name, string $email, string $message): void
    {
        $stmt = Database::pdo()->prepare(
            "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)"
        );
        $stmt->execute(['name' => $name, 'email' => $email, 'message' => $message]);
    }

    public function all(): array
    {
        $stmt = Database::pdo()->query(
            "SELECT id, name, email, message, created_at FROM contacts ORDER BY id DESC"
        );
        return $stmt->fetchAll();
    }
}
