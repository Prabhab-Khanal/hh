<?php
$controller = new AuthController();

$this->router->get('/', fn() => $controller->home());
$this->router->get('/register', fn() => $controller->registerForm());
$this->router->post('/register', fn() => $controller->register());
$this->router->get('/login', fn() => $controller->loginForm());
$this->router->post('/login', fn() => $controller->login());
$this->router->get('/logout', fn() => $controller->logout());
$this->router->get('/dashboard', fn() => $controller->dashboard());
