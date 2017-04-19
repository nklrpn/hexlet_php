<?php

/**
 * Zip
 * 
 * // Returns [['one', 1], ['two', 2], ['three', 3]]
 * zip(['one', 'two', 'three'], [1, 2, 3]);
 *
 * // Returns ['one|1', 'two|2', 'three|3']
 * zip(
 *   ['one', 'two', 'three'],
 *   [1, 2, 3],
 *   function ($one, $two) {
 *       return $one . '|' . $two;
 *   }
 * );
 */

// [1, 2] zip with [3, 4] [[1, 3] [2, 4]]
$result = array_map(null, range(1, 3), range(11, 13));
$result = zip(range(1, 3), range(11, 13));

$result = array_map(function($a, $b) {
	return $a + $b;
}, range(1, 3), range(11, 13));

// =================================================

/**
 * Реализуйте функцию bestAttempt которая принимает на вход результаты попыток 
 * и возвращает массив со списком имен футбольных клубов, которые победили в каждой из попыток. Если результатом попытки была ничья, то в результирующем массиве она не фигурирует (потому что никто не победил).
 * 
 * Пример:
 *   $firstClubAttempts = [['name' => 'milan', 'scored' => 1], ['name' => 'milan', 'scored' => 0]];
 *   $secondClubAttempts = [['name' => 'porto', 'scored' => 1], ['name' => 'porto', 'scored' => 1]];
 * 
 *   ['porto'] == bestAttempt($firstClubAttempts, $secondClubAttempts);
 * 
 * Подсказки:
 *   array_map сохраняет ключи. Чтобы их сбросить, используйте array_values
 */
 
// BEGIN (write your solution here)
function bestAttempt($firstClubAttempts, $secondClubAttempts) {
    $res = array_map(function($a, $b) {
        if ($a['scored'] == $b['scored']) {
            return null;
        }
        
        if ($a['scored'] > $b['scored']) {
            return $a['name'];
        } 
        
        return $b['name'];
    }, $firstClubAttempts, $secondClubAttempts);
    
    return array_values(array_filter($res));
}
// END