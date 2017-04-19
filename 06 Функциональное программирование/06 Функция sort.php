<?php

$collection = ['first' => 'dog', 'second' => 'cat', 'third' => 'bird'];

usort($collection, function($left, $right) {
	return strcmp($left, $right);
}); 

print_r($collection);

// =========================================================

$result = fsort($users, function($user1, $user2) {
	if ($user1->getAge() == $user2->getAge()) {
		return 0;
	}
	
	return ($user1->getAge() < $user2->getAge()) ? -1 : 1;
});

// =========================================================

/**
 * Реализуйте функцию sortByBinary, 
 * которая сортирует переданную коллекцию и возвращает новую коллекцию. 
 * Сортировка происходит следующим образом:
 * 
 * Сортируем по количеству единиц в бинарном представлении (порядок следования не важен).
 * Если количество единиц одинаково, то сортируем на основе десятичного представления.
 * Пример:
 *   [1, 2, 4, 3] == sortByBinary([3, 4, 2, 1]);
 */

// BEGIN (write your solution here)
function sortByBinary($collection)
{
    $countOfOne = function($s) {
        return substr_count(decbin($s), '1');
    };
    
    $result = fsort($collection, function($a, $b) use ($countOfOne) {
       if ($countOfOne($a) == $countOfOne($b)) {
           if ($a == $b) {
               return 0;
           }
           
           return ($a < $b) ? -1 : 1;
       }
       
       return ($countOfOne($a) < $countOfOne($b)) ? -1 : 1;
    });
    
    return $result;
}
// END

