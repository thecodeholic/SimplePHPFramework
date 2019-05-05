<?php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../Request.php';
require_once __DIR__ . '/../Router.php';
require_once __DIR__ . '/../db/Database.php';

session_start();

$db = new Database();

$router = new Router(new Request);

$router->get('/', 'index');
$router->get('/profile', 'profile');
$router->get('/about', function ($request) {
    return <<<HTML
  <h1>about</h1>
HTML;
});
$router->get('/login', 'login');
$router->get('/logout', function(){
    session_unset();
    session_destroy();
    redirect('/');
});
$router->post('/submit-login', function (IRequest $request) use ($router, $db) {
    $body = $request->getBody();
    if ($db->loginUser($body['email'], $body['password'])) {
        redirect('/');
    } else {
        redirect('/login');
    }
});
$router->post('/data', function ($request) {
    return json_encode($request->getBody());
});
