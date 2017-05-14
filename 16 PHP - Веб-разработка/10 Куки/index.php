<?php

namespace App;

use function App\response;
use function App\Renderer\render;

require_once '/composer/vendor/autoload.php';

$app = new Application();

$goods = ['milk', 'salt', 'beef', 'chiken', 'butter'];

$app->get('/', function ($meta, $params, $attributes, $cookies) use ($goods) {
    return response(render('index', ['goods' => $goods]));
});

// BEGIN (write your solution here)
$app->get('/cart', function ($meta, $params, $attributes, $cookies) use ($goods) {
    $cart = (array_key_exists('cart', $cookies)) ? $cookies['cart'] : [];
    
    return response(render('cart', ['goods' => json_decode($cart, true)]));
});

$app->post('/cart', function ($meta, $params, $attributes, $cookies) use ($goods) {
    $cart = (array_key_exists('cart', $cookies)) ? json_decode($cookies['cart'], true) : [];
    $good = $params['good'];
    if (array_key_exists($good, $cart)) {
        $cart[$good]++;
    } else {
        $cart[$good] = 1;
    }
    
    return response()->redirect('/cart')->withCookie('cart', json_encode($cart));
});

$app->delete('/cart', function ($meta, $params, $attributes, $cookies) use ($goods) {
    $cart = (array_key_exists('cart', $cookies)) ? json_decode($cookies['cart'], true) : [];
    $good = $params['good'];
    unset($cart[$good]);
    
    return response()->redirect('/cart')->withCookie('cart', json_encode($cart));
});
// END

$app->run();
