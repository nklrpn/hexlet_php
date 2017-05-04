<?php

namespace Theory;

require_once 'Template.php';

use function Theory\Template\render;

/*
$app->get('/companies', function () {
    return '<p>companies list</p>';
});
*/


$html = render('index.phtml', [
    'site' => 'hexlet.io',
    'subprojects' => ['map.hexlet.io', 'battle.hexlet.io']
]);

print_r($html);