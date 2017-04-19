<?php

namespace App\Pair;

function cons($x, $y)
{
    return function ($method) use ($x, $y) {
        switch ($method) {
            case "car":
                return $x;
            case "cdr":
                return $y;
        }
    };
}

function car($pair)
{
    return $pair("car");
}

function cdr($pair)
{
    return $pair("cdr");
}

function makeList()
{
    return array_reduce(array_reverse(func_get_args()), function ($acc, $item) {
        return cons($item, $acc);
    });
}

function listToString($list)
{
    $arr = [];
    $iter = function ($items) use (&$arr, &$iter) {
        if ($items != null) {
            $arr[] = car($items);
            $iter(cdr($items));
        }

    };
    $iter($list);

    return "(" . implode(", ", $arr) . ")";
}
