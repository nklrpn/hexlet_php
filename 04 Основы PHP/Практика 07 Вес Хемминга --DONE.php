<?php

/**
 * Реализуйте функцию hammingWeight, которая считает вес Хамминга.
 * Пример:
 *   0 == hammingWeight(0)
 *   1 == hammingWeight(4)
 *   4 == hammingWeight(101)
 */
 
// BEGIN (write your solution here)
function hammingWeight($num) {
    str_replace('1', '', decbin($num), $count);

    return $count;
}
// END
 