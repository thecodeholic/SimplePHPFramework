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
$router->get('/about', function (IRequest $request) use ($router){
    return $router->renderOnlyView('about');
});
$router->get('/login', function () use ($router) {
    return $router->renderOnlyView('login', [
        'errors' => [],
        'data' => [
            'email' => '',
            'password' => ''
        ]
    ]);
});
$router->get('/logout', function () {
    session_unset();
    session_destroy();
    redirect('/');
});
$router->post('/login', function (IRequest $request) use ($db, $router) {
    $body = $request->getBody();
    if ($db->loginUser($body['email'], $body['password'])) {
        redirect('/');
    } else {
        return $router->renderOnlyView('login', [
            'errors' => [
                'password' => 'Username or password is incorrect',
            ],
            'data' => [
                'email' => $body['email'],
                'password' => $body['password']
            ]
        ]);
//        renderViewWithErrors('login', ['error' => 'იმეილი ან პაროლი არასწორია']);
//        redirect('/login');
    }
});
