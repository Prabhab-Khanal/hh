<?php
$controller = new ContactController();

$this->router->get('/', fn() => $controller->form());
$this->router->post('/send', fn() => $controller->send());
$this->router->get('/admin', fn() => $controller->admin());
