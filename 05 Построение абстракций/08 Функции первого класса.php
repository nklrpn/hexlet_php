<?php

function sumGenerator($func) {
    return function($a, $b) use ($func) {
        return sum($a, $b, $func);
    };
}

function sum($a, $b, $func) {
    if ($a > $b) {
        return 0;
    }
    
    return $func($a) + sum($a + 1, $b, $func);
}

$sumIntegers = sumGenerator(function($x) { 
    return $x * $x;
});

echo "\n", $sumIntegers(1, 5);

$sumCubes = sumGenerator(function($x) { 
    return $x * $x * $x;
});

echo "\n", $sumCubes(1, 5);

// ===========================================

/* 
 * Пример определения функции, 
 * которая возводит свой аргумент в переданную степень (как замыкание). 
 */

// Через прямое определение лямбды.

$exponent = 3;

$func = function ($number) use ($exponent) {
    return $number ** $exponent; // операция возведения в степень
};

8 == $func(2); // 2^3


// Через функцию, которая внутри себя определяет точно такую же лямбду и возвращает ее.

function power($exponent)
{
    return function ($number) use ($exponent) {
        return $number ** $exponent; // операция возведения в степень
    };
};

$func = power(3);
8 == $func(2); // 2^3

// ======================================

function double($func)
{
    // BEGIN (write your solution here)
    return function($num) use ($func) {
        return $func($func($num));
    };
    // END
}

$inc = function ($arg) {
    return $arg + 1;
};

$inc2 = double($inc);

echo "\n", $inc2(2); // 4
echo "\n", $inc2(10); // 12

// ===

function factor($multiplier)
{
    // BEGIN (write your solution here)
    return function($num) use ($multiplier) {
        return $num * $multiplier;
    };
    // END
}

$multiTwo = factor(2);

echo "\n", $multiTwo(2); // 2 * 2
echo "\n", $multiTwo(10); // 10 * 2

$multiTen = factor(10);
echo "\n", $multiTen(1); // 10
echo "\n", $multiTen(0); // 0

echo "\n", str_repeat('=', 10);