<?php

require 'base.php';

function sum($list)
{
	$iter = function($list, $acc) use (&$iter) {
		if ($list == null) {
			return $acc;
		}
		
		return $iter(cdr($list), $acc + car($list));
	}
	
	return $iter($list, 0);
}

// =============================================

function accumulate($list, $func, $acc)
{
	$iter = function($list, $acc) use (&$iter, $func) {
		if ($list == null) {
			return $acc;
		}
		
		return $iter(cdr($list), $func(car($list), $acc));
	}
	
	return $iter($list, 0);
}

// ==============================================

// BEGIN (write your solution here)
function solution($list)
{
    $round = map(function($x) {
        return ceil($x);
    }, $list);
    
    $even = filter(function($x) {
        return ($x % 2 == 0);
    }, $round);
    
    $product = reduce(function($x, $acc) {
        return ($acc *= $x);
    }, $even, 1);
    
    $result = $product;
    
    return $result;
}
// END
