<?php
function cons($x, $y) {
    return function($method) use ($x, $y) {
        switch ($method) {
            case 'car':
                return $x;
            case 'cdr':
                return $y;
        }
    };
}

function car($pair) {
    return $pair('car');
}

function cdr($pair) {
    return $pair('cdr');
}

$pair = cons(1, 2);
echo "\n", car($pair);
echo "\n", cdr($pair);

// ============================================

/*
 * В текущем задании представлен другой способ реализации пар.
 * Допишите функцию car основываясь на том как работает функция cons.
 * Допишите функцию cdr основываясь на том как работает функция cons.
 */
 
 function cons($x, $y)
{
    return function ($func) use ($x, $y) {
        return $func($x, $y);
    };
}

function car(callable $pair)
{
    // BEGIN (write your solution here)
    return $pair(function ($first, $second) {
        return $first;
    });
    // END
}

function cdr(callable $pair)
{
    // BEGIN (write your solution here)
    return $pair(function ($first, $second) {
        return $second;
    });
    // END
}