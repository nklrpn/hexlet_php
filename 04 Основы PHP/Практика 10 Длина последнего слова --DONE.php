<?php

/**
 * Реализуйте функцию lengthOfLastWord, 
 * которая возвращает длину последнего слова переданной на вход строки. 
 * Словом считается любая последовательность не содержащая пробелов.
 *
 * Примеры:
 *   0 == lengthOfLastWord('');
 *   5 == lengthOfLastWord('man in BlacK');
 *   6 == lengthOfLastWord('hello, world!  ');
 */
 
// BEGIN (write your solution here)
function lengthOfLastWord($str) {
    $words = explode(' ', trim($str));

    if (count($words)) {
        return strlen(array_pop($words));
    }

    return;
}
// END 