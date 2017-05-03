<?php

/**
 * Другой способ добавлять обработчики маршрутов в App это использовать методы, 
 * названные по именам глаголов http. Например $app->get($path, $func).
 * 
 * Реализуйте интерфейс ApplicationInterface в классе Application.
 * 
 * Пример:
 *   <?php
 *   $app = new \App\Application();
 * 
 *   $app->get('/', function () {
 *       return 'hello, world!';
 *   });
 * 
 *   $app->post('/sign_in', function () {
 *       return 'sign in';
 *   });
 * 
 *   $app->run();
 * 
 * Подсказки
 *   $_SERVER['REQUEST_METHOD'] - содержит текущий http метод.
 */
 
namespace App;

interface ApplicationInterface
{
    public function get($path, $func);
    public function post($path, $func);
    public function run();
}

namespace App;

class Application implements ApplicationInterface
{
    // BEGIN (write your solution here)
    private $handlers = [];

    public function get($route, $handler)
    {
        $this->handlers[] = ['GET', $route, $handler];
    }

    public function post($route, $handler)
    {
        $this->handlers[] = ['POST', $route, $handler];
    }

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        
        foreach ($this->handlers as $item) {
            list($handlerMethod, $route, $handler) = $item;
            $preparedRoute = preg_quote($route, '/');
            
            if ($method == $handlerMethod && preg_match("/^$preparedRoute$/i", $uri)) {
                echo $handler();
                return;
            }
        }
    }
    // END
}