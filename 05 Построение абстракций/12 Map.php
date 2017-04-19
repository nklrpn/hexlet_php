<?php

require 'base.php';

$map = function($func, $list) use (&$map) {
	if ($list == null) {
		return null;
	}
	
	$rest = $map($func, cdr($list));
	
	return cons($func(car($list)), $rest);
}

// =========================================

function map($func, $list)
{
    // BEGIN (write your solution here)
    $iter = function ($list, $acc) use (&$iter, $func) {
        if ($list === null) {
            return reverse($acc);
        }

        return $iter(cdr($list), cons($func(car($list)), $acc));
    };
    return $iter($list, null);
	// END
}
