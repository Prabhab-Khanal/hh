<?php
$controller = new CsvController();

$this->router->get('/', fn() => $controller->uploadForm());
$this->router->post('/upload', fn() => $controller->upload());
$this->router->get('/latest', fn() => $controller->latest());
$this->router->post('/clear', fn() => $controller->clearLatest());
