<?php

/**
 * Реализуйте функцию isPowerOfThree которая определяет, 
 * является ли переданное число натуральной степенью тройки. 
 * Например число 27 это третья степень (33), а 81 это четвертая (34).
 * 
 * Пример:
 *   isPowerOfThree(1); // true (3^0)
 *   isPowerOfThree(3); // true
 *   isPowerOfThree(4); // false
 *   isPowerOfThree(9); // true
 */
 
/ BEGIN (write your solution here)
function isPowerOfthree($num) {
    $power = log($num, 3);

    return ctype_digit((string)$power);
}
// END
 