<?php

/* $balance = 100; */

function deposit(&$balance, $amount)
{
	$balance += $amount;
}

function newDeposit($balance)
{
	return function($amount) use (&$balance) {
		$balance += $amount;
		
		return $balance;
	};
}

$balance = 100;
deposit($balance, 10);
echo $balance; // 110

$d = newDeposit(100);
echo $d(10); // 110
echo $d(10); // 120

$d2 = newDeposit(100);
echo $d2(30); // 130

echo $d(10); // 130
echo $d(10); // 140

// =================================

/*
 * Напишите функцию newWithdraw, которая снимает деньги со счета. 
 * При попытке снять больше денег, чем есть на счете, она должна возвращать too much.
 * 
 * Пример:
 * $withdraw = newWithdraw(100);
 * $withdraw(1000); // 'too much'
 * $withdraw(50); // 50
 * $withdraw(45); // 5
 */
 // BEGIN (write your solution here)
function newWithdraw($balance)
{
	return function($amount) use (&$balance) {
		if ($balance - $amount < 0) {
		    return 'too much';
		}
		
		$balance -= $amount;
		
		return $balance;
	};
}
// END
 
 