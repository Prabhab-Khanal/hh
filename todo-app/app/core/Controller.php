<?php
declare(strict_types=1);

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $base = __DIR__ . '/../views/';
        $file = $base . $view . '.php';

        if (!file_exists($file)) {
            throw new RuntimeException("View not found: " . $file);
        }

        require $base . 'layouts/header.php';
        require $file;
        require $base . 'layouts/footer.php';
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . $path);
        exit;
    }

    protected function requirePost(): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            exit;
        }
    }

    protected function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
