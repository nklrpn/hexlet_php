<?php

namespace Theory;

require_once 'Sender.php';

class WorkerTest extends \PHPUnit_Framework_TestCase
{
    private $stub;
    
    public function setUp()
    {
        // Limitation: final, private and static methods
        $this->stub = $this->getMockBuilder('Theory\Sender')
                            ->setMethods(['send'])
                            ->getMock();
    }
    
    public function testFreshStub()
    {
        $this->assertEquals(null, $this->stub->send());
    }
    
    public function testStub()
    {
        // Configure the stub.
        $this->stub->method('send')
                ->willReturn(true);
        
        $this->assertTrue($this->stub->send());
    }
    
    public function testStub2()
    {
        // Configure the stub
        $this->stub->method('send')
                ->will($this->returnArgument(0));
        
        // Stub->send('foo') returns 'foo'
        $this->assertEquals('foo', $this->stub->send('foo'));
        
        // Stub->send('bar') returns 'bar'
        $this->assertEquals('bar', $this->stub->send('bar'));
    }
}


/**
 * Протестируйте, что метод build возвращает true в случае когда он вызван без аргументов и 
 * с аргументом true, который выставляет дебаг режим. 
 * "Застабьте" логгер.
 * 
 * Пример:
 * 
 * $logger = new Logger();
 * $builder = new Builder($logger);
 * 
 * $builder->build(); // true
 * $builder->build(true); // true
 * 
 */
 
class TestSolution extends \PHPUnit_Framework_TestCase
{
    // BEGIN (write your solution here)
    private $builder;

    public function setUp()
    {
        $stub = $this->getMockBuilder('App\LoggerInterface')
            ->setMethods(['info', 'debug'])
            ->getMock();

        $this->builder = new Builder($stub);
    }

    public function testBuilderWithoutDebug()
    {
        $this->assertTrue($this->builder->build());
    }

    public function testBuilderWithDebug()
    {
        $this->assertTrue($this->builder->build(true));
    }
    // END
}

