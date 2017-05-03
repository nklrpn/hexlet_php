<?php

namespace Theory;

require_once 'Application.php';

/**
    if ('/' === $url) {
        return '<p>Welcome to PHP</p>';
    } elseif ('/about' === $url) {
        return 'about company';
    } elseif ('/server' === $url) {
        print_r($_SERVER);
    } 
*/

$routes = [
   ['/', function () {
       return '<p>Main page</p>';
   }],
   ['/sign_in', function () {
       return 'you signed in';
   }],
];

$app = new Application($routes);
$app->run();