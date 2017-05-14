<?php

namespace App;

require_once '/composer/vendor/autoload.php';

use function App\response;
use function App\Renderer\render;

$app = new Application();

$app->get('/', function ($meta, $params, $attributes, $cookies, $session) {
    $session->start();
    $nickname = $session->get('nickname');
    return response(render('index', ['nickname' => $nickname]));
});

// BEGIN (write your solution here)
$app->get('/session/new', function ($meta, $params, $attributes, $cookies, $session) {
    return response(render('session/new'));
});

$app->post('/session', function ($meta, $params, $attributes, $cookies, $session) {
    $session->start();
    $session->set('nickname', $params['nickname']);
    
    return response()->redirect('/');
});

$app->delete('/session', function ($meta, $params, $attribute, $cookies, $session) {
    $session->start();
    $session->destroy();
    
    return response()->redirect('/');
});
// END

$app->run();
