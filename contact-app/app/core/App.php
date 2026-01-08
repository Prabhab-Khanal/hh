<?php
declare(strict_types=1);

final class App
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->registerRoutes();
    }

    public function run(): void
    {
        Session::start();
        $url = $_GET['url'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->router->dispatch($method, $url);
    }

    private function registerRoutes(): void
    {
        // Overridden per app in app/routes.php
        require __DIR__ . '/../routes.php';
    }
}
