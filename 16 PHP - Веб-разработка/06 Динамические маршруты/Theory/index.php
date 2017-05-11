<?php

namespace App;

require_once 'Application.php';

$app = new Application();

$app->get('/users/(?P<id>\d+)', function ($params, $arguments) {
    return json_encode($arguments);
});

$app->get('/users/(?P<userId>\d+)/articles/(?P<id>[\w-]+)', function ($params, $arguments) {
    return json_encode($arguments);
});

$app->run();