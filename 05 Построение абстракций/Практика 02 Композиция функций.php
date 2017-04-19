<?php

/**
 * Пусть f и g — две одноаргументные функции. 
 * По определению, композиция (composition) f и g есть функция x → f ( g (x) ).
 * 
 * Определите функцию compose которая реализует композицию.
 * 
 * Пример:
 *   $square = function ($num) {
 *     return  $num ** 2;
 *   };
 * 
 *   $half = function ($num) {
 *     return  $num / 2;
 *   };
 * 
 *   $func1 = compose([$square, $half]);
 *   25 == $func1(10);
 * 
 *   $func2 = compose([]);
 *   3 == $func2(3);
 */
 
 