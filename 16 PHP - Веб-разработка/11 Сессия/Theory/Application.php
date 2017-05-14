<?php

namespace Theory;

require_once '../exercise/Application.php';
require_once '../exercise/Response.php';

use function App\response;

$app = new \App\Application();

$app->get('/', function () {
    session_start();
    
    return response(print_r($_SESSION, true));
});

$app->get('/session/new', function ($meta, $params) {
    session_start();
    $_SESSION = $params;
    
    return response()->redirect('/');
});

$app->get('/session/destroy', function ($meta, $params) {
    session_start();
    session_destroy();
    
    return response()->redirect('/');
});

$app->run();