<?php

function random($seed)
{
	$reset = function(&$seed) {
		return $seed;
	};
	
	return function() use (&$seed) {
		$a = 45;
		$c = 21;
		$m = 67;
		
		$seed = ($a * $seed + $c) % $m;
		
		return $seed;
	}
}

/* MAIN */

$r = random(10);

echo $r(), PHP_EOL; 	// 2
echo $r(), PHP_EOL;		// 44
echo $r(), PHP_EOL;		// 58
echo $r(), PHP_EOL;		// 18

// =======================================

/**
 * Измените функцию random так, чтобы можно было обнулять сгенерированную последовательность
 * 
 * Пример:
 *   $seq = random(3);
 *   $result = $seq(); // 22
 *   $seq(); // 6
 *   $seq(); // 23
 *   
 *   $seq("reset");
 *   
 *   $result == $seq(); // 22
 */
 
// BEGIN (write your solution here)
function random($seed)
{
	$init = $seed;
	
	return function($method = null) use (&$seed, $init) {
		$a = 45;
		$c = 21;
		$m = 67;
		
		switch ($method) {
		    case 'reset':
		        $seed = $init;
		        break;
	        default:
	            $seed = ($a * $seed + $c) % $m;
		}
		
		return $seed;
	};
}
// END