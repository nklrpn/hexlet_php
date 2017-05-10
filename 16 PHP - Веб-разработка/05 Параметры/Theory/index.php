<?php

namespace App;

require_once 'Application.php';

$app = new Application();

$app->get('/', function () {
    /* $_REQUEST */
    return json_decode($_GET);
});

$app->post('/'. function () {
    return json_decode($_GET);
});

$app->run();