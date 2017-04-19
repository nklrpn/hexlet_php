<?php
function factorial($num)
{
    $iter = function($num, $acc) use (&$iter) {
        if ($num < 2) {
            return $acc;
        }

        return $iter($num - 1, $acc * $num);
    };

    return $iter($num, 1);
}

// ==========================================

function sum2($start, $finish, $func) {
    $iter = function($start, $acc) use ($finish, $func, &$iter) {
        if ($start > $finish) {
            return $acc;
        }
        
        return $iter($start + 1, $acc + $func($start));
    };
    
    return $iter($start, 0);
}

echo "\n", sum2(1, 5, function($x) { return $x * $x; });

// ===========================================

function sum($a, $b, $func) {
    if ($a > $b) {
        return 0;
    }
    
    return $func($a) + sum($a + 1, $b, $func);
}

$identity = function($x) {
    return $x * $x;
};

echo sum(1, 5, $identity);

// ==========================================

function product($num1, $num2, $func) {
    if ($num1 == $num2) { 
        return $num2;
    }
    
    return $func(product($num1, $num2 - 1, $func), $num2);
}

$identity = function($x, $y) {
    return $x * $y;
};

echo "\n", product(3, 5, $identity);