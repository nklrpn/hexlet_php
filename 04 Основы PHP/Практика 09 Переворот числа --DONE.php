<?php

/**
 * Реализуйте функцию reverseInt, которая переворачивает цифры в переданном числе:
 * 
 * 31 == reverseInt(13);
 * -321 == reverseInt(-123);
 */
 
// BEGIN (write your solution here)
function reverseInt($num) {
    $unsigned = abs($num);
    $sign = ($num < 0) ? '-' : '';

    return $sign . strrev((string)$unsigned);
}
// END
