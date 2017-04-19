<?php

require 'base.php';

$removeOdds = function($list) use (&$removeOdds) {
	if ($list == null) {
		return null;
	} 
	
	$curr = car($list);
	
	$rest = $removeOdds(cdr($list));
	
	if ($curr % 2 == 0) {
		return cons($curr, $rest);
	} else {
		return $rest;
	}	
};

// =================================================

function filter($func, $list) 
{
	$iter = function ($list, $acc) use (&$iter, $func) {	
		if (cdr($list) === null) {
			return reverse($acc);
		}
		
		$rest = ($func(car($list)) ? cons(car($list), $acc) : $acc;
		
		return $iter(cdr($list), $rest));
    };
	
    return $iter($list, null);
}
