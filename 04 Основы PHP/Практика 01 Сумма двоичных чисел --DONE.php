<?php

/**
 * Практика: Сумма двоичных чисел
 * 
 * Реализуйте функцию binarySum, которая складывает переданные бинарные числа (как строки):
 *   '11' == binarySum('10', '01');
 *   '10010' == binarySum('1101', '101');
 */ 
 
// BEGIN (write your solution here)
function binarySum($a, $b) {
    return decbin(bindec($a) + bindec($b));
}
// END


