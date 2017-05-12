<?php

namespace App;

require_once 'Application.php';

$app = new Application();

$app->get('/', function ($params, $arguments) {
    return 'Hello World!';
});

$app->post('/sign_in', function ($params, $arguments) {
    $headers = getallheaders();
    
    error_log(print_r($_SERVER, true));
    http_response_code(302);
    header("Location: http://localhost:8080");
    
    return print_r($headers, true);
});

$app->run();