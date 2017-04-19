<?php

/**
 * Реализуйте функцию fib находящую числа Фибоначчи. Аргументом функции является порядковый номер числа.
 * 
 * Формула:
 *   f(0) = 0
 *   f(1) = 1
 *   f(n) = f(n-1) + f(n-2)
 * Пример:
 *   2 == fib(3)
 *   5 == fib(5)
 *   55 == fib(10)
 */
 
// BEGIN (write your solution here)
function fib($num) {
    if ($num == 0) {
        return 0;
    }

    if ($num < 3) {
        return 1;
    }

    return fib($num - 2) + fib($num - 1);
}
// END