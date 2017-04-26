<?php

/**
 * 
 * $http = new Http();
 * $sender = new Sender($http);
 * $sender->send($msg);
 * 
 */

// Http class
namespace Theory;

class Http
{
    public function post($msg)
    {
        return true;
    }
}

// Sender class
namespace Theory;

class Sender
{
    public $http;
    
    public function __construct($http)
    {
        $this->http = $http;
    }
    
    public function send($msg)
    {
        return $this->http->post($msg, []);
    }
} 
 
// Test class
namespace Theory;

require_once 'Http.php';
require_once 'Sender.php';

class SenderTest extends \PHPUnit_Framework_TestCase
{
    public function testSend()
    {
        $msg = 'hello world';
        
        $http = $this->getMockBuilder('Http')
                    ->setMethods(['post'])
                    ->getMock();
                    
        $http->expect($this->once())
            ->method('post')
            ->with(
                $this->equalTo($msg),
                $this->anything()
            );
        
        $sender = new Sender($http);
        $sender->send($msg);
    }
}


/**
 * Существует подход для работы с базой данных, 
 * в котором сама сущность отвечает за свое сохранение в базу. 
 * Этот подход называется ActiveRecord. 
 * С точки зрения грамотной архитектуры это решение не очень хорошее, 
 * но благодаря простой реализации является весьма популярным среди программистов. 
 * Да и большинство фреймворков внутри себя содержат orm, 
 * реализованную именно как ActiveRecord.
 * 
 * Напишите тесты на то, что внутри класса User правильно вызывается метод query объекта, отвечающего за соединение с базой данных. Правила работы метода query такие:
 * 
 * Вызов save на свежесозданном объекте приводит к однократному вызову query.
 * Повторный вызов (без изменения объекта) не выполняет запроса к базе.
 * Вызов методов setFirstName или setLastName приводит к тому что сохранение снова выполнит запрос.
 * 
 * Пример:
 *   $connection = new Db();
 *   $user = new User($connection);
 * 
 *   $user->save(); // true
 *   $user->setFirstName("John");
 *   $user->save(); // true
 *   $user->save(); // false
 */

class TestSolution extends \PHPUnit_Framework_TestCase
{
    // BEGIN
    private $user;
    private $connection;

    public function setUp()
    {
        $this->connection = $this->getMockBuilder('App\DbInterface')
            ->setMethods(['query', 'transaction'])
            ->getMock();

        $this->user = new User($this->connection);
    }

    public function testSaveNew()
    {
        $this->connection->expects($this->once())
            ->method('query');

        $this->user->save();
    }

    public function testTrySaveTwice()
    {
        $this->connection->expects($this->once())
            ->method('query');

        $this->user->save();
        $this->user->save();
    }

    public function testSaveTwice()
    {
        $this->connection->expects($this->exactly(2))
            ->method('query');

        $this->user->save();

        $this->user->setFirstName('John');
        $this->user->save();
    }
    // END
}