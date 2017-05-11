<?php

/**
 * Другой способ работы с роутингом это плейсхолдеры. 
 * Пример: /users/:id. Плейсхолдеры это такие "заполнители", 
 * которые используются вместо написания регулярного выражения напрямую. 
 * Удобство заключается в том что их гораздо проще использовать и понимать.
 * 
 * Пример:
 * 
 * <?php
 * $app = new Application();
 * 
 * $app->get('/users/:id', function ($params, $arguments) {
 *     // $params['id'] будет содержать часть uri из :id
 *     return json_encode($arguments);
 * });
 * $ curl localhost:8080/users/3
 * {id: 3}
 * Обычно на плейсхолдеры не накладывается ограничений. 
 * Они могут появляться внутри uri в любом месте. 
 * Например мы можем определить такой маршрут: /users/:userId/photos/:id.
 * 
 * Реализуйте работу с плейсхолдерами в src/app/Application.php.
 * 
 * Алгоритм работы с плейсхолдерами достаточно прост. 
 * Все работает практически так же как и с регулярными выражениями + один шаг. 
 * На этом шаге плейсхолдеры заменяются на регулярные выражения. 
 * По умолчанию регулярное выражение, на которое заменяются плейсхолдеры, 
 * это [\w-]+, при этом не забывайте что группа должна быть именованной.
 */
 
namespace App;

class Application
{
    private $handlers = [];

    public function get($route, $handler)
    {
        $this->append('GET', $route, $handler);
    }

    public function post($route, $handler)
    {
        $this->append('POST', $route, $handler);
    }

    private function append($method, $route, $handler)
    {
        // BEGIN (write your solution here)
        $updatedRoute = $route;
        
        if (preg_match_all('/:([^\/]+)/', $route, $matches)) {
            $updatedRoute = array_reduce($matches[1], function ($acc, $value) {
                $group = "(?P<$value>[\w-]+)";
                
                return str_replace(":{$value}", $group, $acc);
            }, $route);
        }
        // END

        $this->handlers[] = [$updatedRoute, $method, $handler];
    }

    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->handlers as $item) {
            list($route, $handlerMethod, $handler) = $item;
            $preparedRoute = str_replace('/', '\/', $route);
            $matches = [];
            if ($method == $handlerMethod && preg_match("/^$preparedRoute$/i", $uri, $matches)) {
                $arguments = array_filter($matches, function ($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);
                echo $handler($_GET, $arguments);
            }
        }
    }
}
