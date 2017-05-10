<?php

/**
 * Реализуйте маршрут /, который может принимать параметр sort и выполнять 
 * сортировку $data в соответствии с содержимым этого параметра. 
 * Формат sort: field direction. field - название поля, 
 * direction - либо asc либо desc. Пример: id desc.
 * 
 * Отдаваемые данные должны кодироваться в json с помощью функции json_encode.
 * 
 * Пример:
 * 
 * <?php
 * 
 * $data = [
 *     ['id' => 4, 'age' => 15],
 *     ['id' => 3, 'age' => 28],
 *     ['id' => 8, 'age' => 3],
 *     ['id' => 1, 'age' => 23]
 * ];
 * 
 * $actual = file_get_contents('http://localhost:8080?sort=age+desc');
 * 
 * $expected = [
 *     ['id' => 3, 'age' => 28],
 *     ['id' => 1, 'age' => 23],
 *     ['id' => 4, 'age' => 15],
 *     ['id' => 8, 'age' => 3]
 * ];
 * 
 * json_encode($expected) == $actual
 */
 
namespace App;

require_once '/composer/vendor/autoload.php';

$app = new Application();

$data = [
    ['id' => 4, 'age' => 15],
    ['id' => 3, 'age' => 28],
    ['id' => 8, 'age' => 3],
    ['id' => 1, 'age' => 23]
];

// BEGIN (write your solution here)
$app->get('/', function ($params) use ($data) {
    if (array_key_exists('sort', $params)) {
        list($sortField, $sortDirection) = explode(' ', $params['sort']);
        
        usort($data, function ($a, $b) use ($sortField, $sortDirection) {
            $aVar = $a[$sortField];
            $bVar = $b[$sortField];
            
            if ($aVar == $bVar) {
                return 0;
            } 
            
            if ($sortDirection == 'desc') {
                return ($aVar < $bVar) ? 1 : -1;
            } else {
                return ($aVar > $bVar) ? 1 : -1;
            }
            
        });
    }
    
    return json_encode($data);
});
// END

// TEACHER'S SOLUTION
$app->get('/', function ($params) use ($data) {
    if (array_key_exists('sort', $params)) {
        list($key, $order) = explode(' ', $params['sort']);

        usort($data, function ($prev, $next) use ($key, $order) {
            $prevValue = $prev[$key];
            $nextValue = $next[$key];

            if ($prevValue == $nextValue) {
                return 0;
            }

            if ($order == 'desc') {
                return $prevValue < $nextValue ? 1 : -1;
            } else if ($order == 'asc') {
                return $prevValue > $nextValue ? 1 : -1;
            }
        });
    }
    return json_encode($data);
});
// END

$app->run();

