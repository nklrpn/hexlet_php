<?php

require 'base.php';

$list = l(1, 4, 5, 8, 9, 100);

function sumOfDoubleOdds($list) 
{
	return accumulate($list, function($item, $acc) {
		if ($item % 2 === 1) {
			return $item * 2 + $acc;
		} else {
			return $acc;
		}
	}, 0);
}

// =============================

function sumOfDoubleOdds($list)
{
	$res = filter($list, function($item) {
		return $item % 2 === 1;
	});
	
	$res2 = map($res, function($item) {
		return $item * 2;
	});
	
	$res3 = accumulate($res2, function($item, $acc) {
		return $item + $acc;
	}, 0);
	
	return $res3;
}

// ================================

/*
 * Реализуйте функцию solution, которая принимает на вход список чисел и выполняет следующие действия:
 *   - удаляет все числа, не кратные трем.
 *   - возводит оставшиеся числа в квадрат.
 *   - возвращает среднее арифметическое списка полученного после предыдущей операции.
 *
 * 22.5 == solution(l(1, 3, 8, 6)) // (3 * 3 + 6 * 6) / 2
 * 
 * Подсказки: Для подсчета числа элементов в списке используйте функцию length
 */
 
// BEGIN (write your solution here)
function solution ($list) {
    $res = filter($list, function($item) {
        return ($item % 3 === 0);
    });
    
    $res2 = map($res, function($item) {
        return $item ** 2; 
    });
    
    $res3 = accumulate($res2, function($item, $acc) {
        return $item + $acc;
    }, 0);
    
    $res4 = $res3 / length($res);
    
    return $res4;
}
// END