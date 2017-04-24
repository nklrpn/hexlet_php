<?php

class StackTest extends \PHPUnit_Framework_TestCase
{
    protected $stack;
    
    protected function setUp()
    {
        $this->stack = [];
    }
    
    public function testEmpty()
    {
        $this->assertTrue(empty($this->stack));
    }
    
    public function testPush()
    {
        array_push($this->stack, 'foo');
        
        $this->assertEquals('foo', $this->stack[count($this->stack) - 1]);
        $this->assertFalse(empty($this->stack));
    }
    
    public function testPop()
    {
        array_pop($this->stack);
        
        $this->assertEquals('foo', array_pop($this->stack));
        $this->assertTrue(empty($this->stack));
    }
}


/**
 * Напишите тесты на класс Config, 
 * который принимает на вход вложенный массив и 
 * рекурсивно строит цепочку вложенных конфигов.
 * 
 * Напишите тесты на метод toArray класса Config, 
 * который возвращает массив значений для текущего уровня вложенности конфига.
 * 
 * Пример:
 * 
 * $data = [
 *     'key' => 'value',
 *     'deep' => [
 *         'key' => [],
 *         'deep' => 3,
 *         'another' => 7
 *     ]
 * ];
 * 
 * $config = new Config($data);
 * 
 * // how it works
 * 
 * 'value' == $config->key;
 * 7 == $config->deep->another;
 * 
 * ['key' => [], 'deep' => 3, 'another' => 7] == $config->deep->toArray();
 * 
 */

class SolutionTest extends \PHPUnit_Framework_TestCase
{
    private $config;
    private $data;

    public function setUp()
    {
        $this->data = [
            'key' => 'value',
            'deep' => [
                'key' => [],
                'deep' => 3,
                'another' => 7
            ]
        ];

        $this->config = new Config($this->data);
    }
    
    public function testSimpleKey()
    {
        // BEGIN (write your solution here)
        $value = $this->config->key;
        $this->assertEquals('value', $value);
        // END
    }

    public function testDeepKey()
    {
        // BEGIN (write your solution here)
        $value = $this->config->deep->another;
        $this->assertEquals(7, $value);
        
        $value = $this->config->deep->deep;
        $this->assertEquals(3, $value);
        
        $value = $this->config->deep->key;
        $this->assertEquals([], $value);
        // END
    }

    public function testToArray()
    {
        // BEGIN (write your solution here)
        $value = $this->config->deep->toArray();
        $this->assertEquals($this->data['deep'], $value);
        // END
    }
}
}
