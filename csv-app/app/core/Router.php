<?php
declare(strict_types=1);

final class Router
{
    /** @var array<string, array<string, callable>> */
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $path, callable $handler): void
    {
        $this->routes['GET'][$this->normalize($path)] = $handler;
    }

    public function post(string $path, callable $handler): void
    {
        $this->routes['POST'][$this->normalize($path)] = $handler;
    }

    public function dispatch(string $method, string $url): void
    {
        $method = strtoupper($method);
        $path = $this->normalize(parse_url($url, PHP_URL_PATH) ?: '/');

        $handler = $this->routes[$method][$path] ?? null;
        if (!$handler) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        call_user_func($handler);
    }

    private function normalize(string $path): string
    {
        $path = '/' . ltrim($path, '/');
        $path = rtrim($path, '/');
        return $path === '' ? '/' : $path;
    }
}
