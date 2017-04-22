<?php

/**
 * QueryBuilder это специальный класс для конструирования sql запросов. 
 * Подобная функциональность есть практически во всех ORM. Пример использования:
 * 
 *   QueryBuilder::from('members')->toSql();
 *   // SELECT * FROM members
 * 
 *   QueryBuilder::from('members')->where('id', 12)->toSql();
 *    // SELECT * FROM members WHERE id = '12'
 * 
 *   QueryBuilder::from('photos')->select('author', 'id')
 *     ->where('views_count', null)->where('state', 'archived')->toSql();
 *   // SELECT author, id FROM photos WHERE views_count IS NULL AND state = 'archived'
 * 
 * Реализуйте тесты для QueryBuilder основываясь на примере выше.
 * 
 */

 
class TestQueryBuilder extends \PHPUnit_Framework_TestCase
{
    public function testDefault()
    {
        // BEGIN
        $builder = QueryBuilder::from('users');
        $expected = 'SELECT * FROM users';
        $this->assertEquals($expected, $builder->toSql());
        // END
    }

    public function testSelect()
    {
        // BEGIN
        $builder = QueryBuilder::from('photos')->select('age', 'name');
        $expected = 'SELECT age, name FROM photos';
        $this->assertEquals($expected, $builder->toSql());
        // END
    }

    // BEGIN
    public function testWhere()
    {
        $builder = QueryBuilder::from('users')
            ->where('age', '18')
            ->where('source', 'facebook');
        $expected = "SELECT * FROM users WHERE age = '18' AND source = 'facebook'";
        $this->assertEquals($expected, $builder->toSql());
    }

    public function testWhereWithNull()
    {
        $builder = QueryBuilder::from('users')
            ->where('email', null);
        $expected = 'SELECT * FROM users WHERE email IS NULL';
        $this->assertEquals($expected, $builder->toSql());
    }
    // END
}

