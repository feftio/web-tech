<?php

$router->get('/', 'main');
$router->get('/auth', 'auth');
$router->get('/verify', 'verify');
$router->post('/signup', 'signup');
$router->post('/signin', 'signin');
$router->get('/hello', 'auth');

?>