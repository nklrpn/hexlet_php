<?php

namespace Theory;

/* spl_autoload_extensions(".php"); 
spl_autoload_register(); */

spl_autoload_register(function ($class) { 
    $path = __DIR__ . '/' . strtolower(str_replace("\\", "/", $class));
    spl_autoload($path);
}

// require 'ns/application.php';

$app = new \ns\Application();

var_dump($app);

// ===================

/**
 * Зарегистрируйте автозагрузчик классов, так чтобы тесты прошли.
 */

namespace App;
 
// BEGIN (write your solution here)
spl_autoload_register(function ($class) { 
    $path = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php'; 
    require_once $path; 
});
// END

class Test extends \PHPUnit_Framework_TestCase
{
    public function testClasses()
    {
        $router = new \Framework\Router();
        $this->assertInstanceOf('Framework\Router', $router);

        $controller = new \Framework\Controller\Base();
        $this->assertInstanceOf('Framework\Controller\Base', $controller);
    }
}
