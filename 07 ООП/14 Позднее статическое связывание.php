<?php

namespace Theory;

class Base
{
    public static function who()
    {
        echo __CLASS__, PHP_EOL;
    }
    
    public static function test()
    {
        self::who();
        static::who();
    }
}

class Child extends Base
{
    public static function who()
    {
        echo __CLASS__, PHP_EOL;
    }
}

echo Base::who();
echo Child::who();

// ===========================

/**
 * BaseModel - это класс, реализующий логику взаимодействия с базой данных. 
 * От него могут наследоваться классы нашей предметной области. 
 * В данном примере это User, Member и Teacher. 
 * В BaseModel определен статический метод getTableName, 
 * который возвращает имя таблицы для хранения экземпляров текущего класса вашего приложения. 
 * Вычисляется он по следующим правилам:
 * 
 * Если задано статическое свойство $tableName, то возвращается его значение.
 * В противном случае берется имя класса (без неймспейса) и приводится к нижнему регистру.
 * file: BaseModel.php
 * Необходимо реализовать статический метод getTableName.
 */

class BaseModel
{
    // BEGIN (write your solution here)
    public static $tableName;
    
    public static function getTableName()
    {
        if (static::$tableName) {
            return static::$tableName;
        }
        
        return strtolower(
            substr(strrchr(get_called_class(), '\\'), 1)
        );
    }
    // END
}

class User extends BaseModel
{
}

class Member extends User
{
    public static $tableName = 'custom_table_for_members';
}

class Teacher extends User
{
}

class Test extends \PHPUnit_Framework_TestCase
{
    public function testUser()
    {
        $this->assertEquals('user', User::getTableName());
    }

    public function testMember()
    {
        $this->assertEquals('custom_table_for_members', Member::getTableName());
    }

    public function testTeacher()
    {
        $this->assertEquals('teacher', Teacher::getTableName());
    }
}
