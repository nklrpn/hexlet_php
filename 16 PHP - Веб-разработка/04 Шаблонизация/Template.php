<?php

namespace App\Template;

function render($template, $variables)
{
    // BEGIN (write your solution here)
    extract($variables);
    ob_start();
    include $template;
    
    return ob_get_clean();
    // END
}
