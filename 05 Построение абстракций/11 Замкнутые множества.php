<?php

// $list = cons(1, cons(2, cons(3, null)));

function listRef($list, $n) {
	if ($n == 0) {
		return car($list);
	}
	
	return listRef(cdr($list), $n - 1);
}

$l = makeList(1, 2, 3);
echo listRef($l, 1); // 2

// exercise =====================================

function reverse($list)
{
    // BEGIN (write your solution here)
    $iter = function ($items, $acc) use (&$iter) {
        if ($items === null) {
            return $acc;
        } else {
            return $iter(cdr($items), cons(car($items), $acc));
        }
    };

    return $iter($list, null);
    // END
}

function length($items)
{
    // BEGIN (write your solution here)
	if ($items === null) {
        return 0;
    } else {
        return 1 + length(cdr($items));
    }
    // END
}

function append($list1, $list2)
{
    // BEGIN (write your solution here)
	if ($list1 === null) {
        return $list2;
    } else {
        return cons(car($list1), append(cdr($list1), $list2));
    }
	// END
}
