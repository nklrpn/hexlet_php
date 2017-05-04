<?php

// BEGIN
namespace App\Renderer;

function render($filepath, $params = [])
{
    $templatepath = 'resources' . DIRECTORY_SEPARATOR . 'views'. DIRECTORY_SEPARATOR . $filepath . '.phtml';
    return \App\Template\Render($templatepath, $params);
}
// END
