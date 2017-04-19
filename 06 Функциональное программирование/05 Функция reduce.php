<?php

$arr = [1, 3, 2, 9, -8, 4];

$result = array_reduce($arr, function($acc, $item) {
    return $item < $acc ? $item : $acc;
}, $arr[0]);

echo $result;

// -8

// ================================================

$arr = [1, 3, 2, 9, 3, 4];

$result = array_reduce($arr, function($acc, $item) {
    if (!array_key_exists($item, $acc)) {
        $acc[$item] = 1;
    } else {
        $acc[$item]++;
    }
    
    return $acc;
}, []);

print_r($result);

// Array
// (
//    [1] => 1
//    [3] => 2
//    [2] => 1
//    [9] => 1
//    [4] => 1
//)

// ================================================

// Functional\reduce_left
$result = reduce_left($array, function($item, $index, $collection, $acc) {
	return $item > $acc ? $item : $acc;
}, $array[0]);

print_r($result);

// ================================================

/**
 * Реализуйте функцию wordsCount, 
 * которая принимает на вход массив слов и возвращает массив, 
 * в котором ключ это слово, а значение это количество раз, 
 * которое это слово встречалось в исходном массиве.
 *
 * Пример:
 *   ['cat' => 1, 'dog' => 1, 'fish' => 2] == wordsCount(['cat', 'dog', 'fish', 'fish'])
 */

use function Functional\reduce_left;
 
// BEGIN (write your solution here)
function wordsCount($arr)
{
	return array_reduce($arr, function($acc, $item) {
	    if (!array_key_exists($item, $acc)) {
	        $acc[$item] = 1;
	    } else {
	        $acc[$item]++;
	    }
	    
	    return $acc;
	}, []);
}
// END
 
// Solution.php
// BEGIN (write your solution here)
function wordsCount($arr)
{ 
	$result = reduce_left($array, function ($item, $index, $collection, $acc) {
        if (!array_key_exists($item, $acc)) {
            $acc[$item] = 0;
        }
        $acc[$item]++;
        return $acc;
    }, []);

    return $result;
}
// END
