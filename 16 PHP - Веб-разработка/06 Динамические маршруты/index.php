<?php

namespace App;

require_once '/composer/vendor/autoload.php';

$app = new Application();

$app->get('/users/:id', function ($params, $arguments) {
    return json_encode($arguments);
});

$app->get('/users/:userId/articles/:id', function ($params, $arguments) {
    return json_encode($arguments);
});

$app->run();


