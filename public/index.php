<?php
include_once '../Request.php';
include_once '../Router.php';


$router = new Router(new Request);

$router->get('/', 'index');
$router->get('/profile', 'profile');
$router->get('/about', function ($request) {
    return <<<HTML
  <h1>about</h1>
HTML;
});
$router->post('/data', function ($request) {
    return json_encode($request->getBody());
});
