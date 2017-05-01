<?php

namespace Theory;

function server($url)
{
    if ('/' === $url) {
        return '<p>Welcome to PHP</p>';
    } elseif ('/about' === $url) {
        return 'about company';
    } elseif ('/server' === $url) {
        print_r($_SERVER);
    }    
}

echo server($_SERVER['REQUEST_URI']);

/**
 * Реализуйте маршрут /about, по которому будет отдаваться строка <h1>about company</h1>. 
 * Выполните сопоставление с REQUEST_URI используя регулярные выражения, 
 * так чтобы один маршрут обрабатывал и концевой слеш (/about/ тоже самое что /about), 
 * и различный регистр (/abOuT, /ABout, /about).
 * 
 * Подсказка
 * Для регулярных выражений используйте preg_match.
 */

namespace App;

require_once '/composer/vendor/autoload.php';

// BEGIN (write your solution here)
function router($uri) {
    if (preg_match('/\/about\/?/i', $uri)) {
        return '<h1>about company</h1>';
    }
    
    return;
}

echo router($_SERVER['REQUEST_URI']);
// END


/**
 * TEACHER'S SOLUTION
 */
// BEGIN
function server($url)
{
    if (preg_match('/^\/about\/?$/i', $url)) {
        return "<h1>about company</h1>";
    }
}

echo server($_SERVER['REQUEST_URI']);
// END
