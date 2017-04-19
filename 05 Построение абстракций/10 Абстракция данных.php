<?php

function addRat($rat1, $rat2) {
	$numer = numer($rat1) * denom($rat2) + numer($rat2) * denom($rat1);
	$denom = denom($rat1) * denom($rat2);
	
	return makeRat($numer, $denom);
}

function printRat($rat) {
	printf("%d/%d", numer($rat), denom($rat));
}

function makeRat($numer, $denom) {
	return cons($numer, $denom);
}

function numer($rat) {
	return car($rat);
}

function denom($rat) {
	return cdr($rat);
}

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

// 

$rat = makeRat(1, 2);

printRat($rat); // 1/2

echo numer($rat); // 1
echo denom($rat); // 2

printRat(addRat($rat, makeRat(2, 3))); // 7/6
printRat(addRat($rat, makeRat(2, 4))); // 8/6



// exercise ============================================

<?php

function makeRat($numer, $denom)
{
    return cons($numer, $denom);
}

function numer($rat)
{
    return car($rat);
}

function denom($rat)
{
    return cdr($rat);
}

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

// BEGIN (write your solution here)
function subRat($rat1, $rat2) {
    $numer = numer($rat1) - numer($rat2);
    $denom = denom($rat1) - denom($rat2);
    
    return makeRat($numer, $denom);
}

function equalRat($rat1, $rat2) {
    return (numer($rat1) / denom($rat1) == numer($rat2) / denom($rat2));
}
// END

// test equalRat
echo "\n", '=== Test equalRat';
$firstNum = 5;
$secondNum = 3;
$rat = makeRat($firstNum, $secondNum);
$sameRat = makeRat($firstNum * 2, $secondNum * 2);
$oppositRat = makeRat($secondNum, $firstNum);

echo "\n", equalRat($rat, $rat) ? 1 : 0; // 1
echo "\n", equalRat($rat, $sameRat) ? 1 : 0; // 1
echo "\n", equalRat($rat, $oppositRat) ? 1 : 0; // 0

// test subRat
echo "\n", '=== Test subRat';
$firstNum = 5;
$secondNum = 3;
$rat = makeRat($firstNum, $secondNum);
$sameRat = makeRat($firstNum * 2, $secondNum * 2);
$oppositRat = makeRat($secondNum, $firstNum);

$newRat = subRat($rat, $rat);
echo "\n", numer($newRat); // 0
echo "\n", denom($newRat); // 3 * 2

$newRat2 = subRat($oppositRat, $rat);
echo "\n", numer($newRat2); // -16
echo "\n", denom($newRat2); // 5 * 3