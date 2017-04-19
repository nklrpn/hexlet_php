<?php

...

use function Functional\partition;

$collection = [new User(), new Admin(), new User()];

list($admins, $users) = partition($collection, function ($user) {
	return $user->isAdmin();
});

print_r($admins);
print_r($users);

// ===============================

/**
 * Реализуйте функцию separateEvenAndOddNumbers, 
 * которая принимает на вход массив чисел и возвращает массив, 
 * в котором первый элемент - это массив четных чисел, 
 * а второй элемент - это массив нечетных чисел, полученных из исходного массива.
 */
 
// BEGIN (write your solution here)
function separateEvenAndOddNumbers($numbers)
{
    return partition($numbers, function ($num) {
        return $num % 2 == 0;
    });
}
// END