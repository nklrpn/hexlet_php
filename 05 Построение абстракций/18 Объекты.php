<?php

function newAccount($balance)
{
	$withdraw = function($amount) use (&$balance) {
		$balance -= $amount;
		
		return $balance;
	};
	
	$deposit = function($amount) use (&$balance) {
		$balance += $amount;
		
		return $balance;
	};
	
	return function($funcName, $amount) use ($withdraw, $deposit) {
		switch ($funcName) {
			case 'withdraw':
				return $withdraw($amount);
				break;
			case 'deposit':
				return $deposit($amount);
				break;				
		}
	};
}

/* MAIN */

$a = newAccount(100);		// 100

echo $a('deposit', 10); 	// 110
echo $a('withdraw', 100); 	// 100

$b = newAccount(100);		// 100
echo $b('deposit', 50); 	// 150

// ==================================================

/**
 * Измените функцию newAccount так, чтобы она создавала счета, защищенные паролем.
 * 
 * Пример:
 *   $acc = newAccount(100, "secret password");
 *   110 == $acc("deposit", 10, "secret password");
 *   60 == $acc("withdraw", 50, "secret password");
 *   "wrong password!" == $acc("deposit", 10, "wrong password");
 */
 
function newAccount($balance, $password)
{
    $withdraw = function ($amount) use (&$balance) {
        $balance -= $amount;
        return $balance;
    };

    $deposit = function ($amount) use (&$balance) {
        $balance += $amount;
        return $balance;
    };

    // BEGIN (write your solution here)
    return function ($funcName, $amount, $p) use ($password, $withdraw, $deposit) {
        if ($password !== $p) {
            return "wrong password!";
        }

        switch ($funcName) {
            case "withdraw":
                return $withdraw($amount);
                break;
            case "deposit":
                return $deposit($amount);
                break;
        }
    };
    // END
}