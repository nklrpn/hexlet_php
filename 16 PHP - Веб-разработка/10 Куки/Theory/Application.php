<?php

namespace Theory;

require_once '../exercise/Application.php';
require_once '../exercise/Response.php';
require_once '../exercise/Renderer.php';
require_once 'UserRepository.php';

use function App\response;
use function App\Renderer\render;

$app = new \App\Application();

$app->get('/', function () {
    return response(render('index', ['cookies' => print_r($_COOKIE, true)]));
});

$app->get('/cookie', function () {
    setcookie('session-cookie', uniqid());
    setcookie('persistent-cookie', uniqid(), time() + 10000);
    setcookie('session-cookie-with-path', uniqid(), 0, '/about');
    setcookie('session-cookie-for-domain', uniqid(), 0, '', 'www.localhost');
    setcookie('session-cookie-with-httponly', uniqid(), 0, '', '', false, true);
    
    return response()->redirect('/');
});

$app->run();