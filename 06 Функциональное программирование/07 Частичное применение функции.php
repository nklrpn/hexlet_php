<?php

$subtractor = function($a, $b) {
	return $a - $b;
};

echo $subtractor(10, 20); // -10

// closure
$subtractror2 = function($a) {
	return function ($b) use ($a) {
		return $a - $b;
	};
};

$partiallyAppliedSubtractor = $subtractror2(10);

echo $partiallyAppliedSubtractor(20); // -10

// ===========================================

/**
 * Реализуйте функцию mapWithPower, которая принимает на вход массив и степень, 
 * и возвращает новый массив, в котором каждое значение возведено в переданную степень.
 * 
 * Пример:
 *   [1, 1, 9, 100, 0] == mapWithPower([-1, 1, 3, 10, 0], 2)
 */
 
// BEGIN (write your solution here)
function mapWithPower($array, $power)
{
    $func = partial_any('pow', …, $power);
	
    return map($array, $func);
}
// END