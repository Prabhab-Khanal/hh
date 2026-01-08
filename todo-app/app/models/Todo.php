<?php
declare(strict_types=1);

final class Todo
{
    public function all(): array
    {
        $stmt = Database::pdo()->query("SELECT id, title, is_done, created_at FROM todos ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function create(string $title): void
    {
        $stmt = Database::pdo()->prepare("INSERT INTO todos (title) VALUES (:title)");
        $stmt->execute(['title' => $title]);
    }

    public function toggle(int $id): void
    {
        $stmt = Database::pdo()->prepare("UPDATE todos SET is_done = 1 - is_done WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function delete(int $id): void
    {
        $stmt = Database::pdo()->prepare("DELETE FROM todos WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
