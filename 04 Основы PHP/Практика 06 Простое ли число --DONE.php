<?php

/**
 * Реализуйте функцию isPrime определяющую, является ли число простым.
 * Пример:
 *   isPrime(1); // false
 *   isPrime(7); // true
 *   isPrime(10); // false
 */
 
// BEGIN (write your solution here)
function isPrime($num) {
    if ($num < 2) {
        return false;
    }

    if ($num == 2) {
        return true;
    }

    foreach (range(2, $num - 1) as $val) {
        if ($num % $val == 0) {
            return false;
        }
    }

    return true;
}
// END
