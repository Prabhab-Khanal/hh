<?php
$controller = new TodoController();

$this->router->get('/', fn() => $controller->index());
$this->router->post('/todo/create', fn() => $controller->create());
$this->router->post('/todo/toggle', fn() => $controller->toggle());
$this->router->post('/todo/delete', fn() => $controller->delete());
