<?php

namespace Theory\Template;

function render($tmpl, $var)
{
    extract($var);
    ob_start();
    include $tmpl;
    
    return ob_get_clean();
}