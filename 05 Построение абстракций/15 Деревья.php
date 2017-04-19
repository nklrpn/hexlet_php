<?php

require 'base.php';

function treeMap($list, $func, $acc)
{
	$iter = function($list, $acc) use (&$iter, $func) {
		if ($list === null) {
			return $acc;
		}
		
		$element = car($list);
		
		if (isPair($element) {
			$newAcc = treeMap($element, $func, $acc);
		} else {
			$newAcc = $func($element, $acc);
		}
		
		return $iter(cdr($list), $newAcc);
	}
	
	return $iter($list, $acc);
}

$list = l(1, 3, l(1, l(2, 3), 2), 9);

$result = treeMap($list, function($list, $acc) {
	return $acc + 1;
}, 0);

// ===================================================
/*
 * Реализуйте функцию reverse, которая переворачивает переданный на вход список рекурсивно.
 * 
 * Подсказки: Функция isPair проверяет является ли значение парой.
 */
 
 function reverse($list)
{
    // BEGIN (write your solution here)
    $iter = function($list, $acc) use (&$iter) {
		if ($list === null) {
			return $acc;
		}
		
		$elem = car($list);
		
		if (isPair($elem)) {
			$res = reverse($elem);
		} else {
			$res = $elem;
		}
		
		return $iter(cdr($list), cons($res, $acc));
	};
	
	return $iter($list, null);
    // END
}
