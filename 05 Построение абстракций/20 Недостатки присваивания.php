<?php

/**
 * Реализуйте функцию fib находящую числа Фибоначчи используя рекурсивно-итеративный процесс, 
 * но вместо аккумулятора параметров для вложенной функции $iter используйте переменные.
 *
 * Формула:
 * 
 *   f(0) = 0
 *   f(1) = 1
 *   f(n) = f(n-1) + f(n-2)
 * 
 * Пример:
 * 
 *   2 == fib(3);
 *   5 == fib(5);
 *   55 == fib(10);
 */
 
function fib($num)
{
    // BEGIN (write your solution here)
    $tmp;
    $fib1 = 0;
    $fib2 = 1;
    $i = 0;

    $iter = function () use ($num, &$iter, &$fib1, &$fib2, &$i) {
        if ($i < $num) {
            $tmp = $fib1;
            $fib1 = $fib2;
            $fib2 = $tmp + $fib2;
            $i += 1;
            $iter();
        }
    };

    $iter();
    return $fib1;
    // END
}