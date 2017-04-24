<?php

class Solution2Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testCubeWithDataset($expected, $argument)
    {
        $this->assertEquals($expected, cube($argument));
    }
    
    public function additionProvider()
    {
        return [
            [1, 1],
            [8, 2],
            [27, 3],
            [-1, -1],
        ];
    }
}

/**
 * Напишите тесты на функцию hasEqualOnesCount, 
 * которая принимает на вход два числа и возвращает true 
 * если количество единиц в двоичном представлении 
 * у этих чисел совпадает и false если не совпадает.
 */

class TestSolution extends \PHPUnit_Framework_TestCase
{
    // BEGIN (write your solution here)
    /**
     * @dataProvider trueProvider
     */
    public function testEqualOnesCountIsTrue($first, $second)
    {
        $this->assertTrue(hasEqualOnesCount($first, $second));
    }
    
    /**
     * @dataProvider falseProvider
     */
    public function testEqualOnesCountIsFalse($first, $second)
    {
        $this->assertFalse(hasEqualOnesCount($first, $second));
        $this->assertFalse(hasEqualOnesCount($first, $second));
    }
    
    public function trueProvider()
    {
        return [
            [1, 1],
            [1, 2],
            [1, 4],
        ];
    }
    
    public function falseProvider()
    {
        return [
            [1, 3],
            [1, 5],
            [1, 7],
        ];
    }    
    // END
    
    // TEACHER'S SOLUTION
    /**
     * @dataProvider additionProvider
     */
    public function testHasEqualOnesCount($actual, $first, $second)
    {
        $this->assertEquals($actual, hasEqualOnesCount($first, $second));
    }

    public function additionProvider()
    {
        return [
            [true, 1, 1],
            [false, -1, 1],
            [false, 5, 2],
            [true, 5, 3],
        ];
    }
    // END
}