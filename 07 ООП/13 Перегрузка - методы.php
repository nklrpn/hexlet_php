<?php

namespace Theory;

/* __call($name, $args); */
/* preg_match("/findBy(.*)/", $finder, $outputArray); */

$repository = new Repository('users');

/* SELECT * FROM `users` WHERE email = 'admin@example.com' LIMIT 1 */
$repository->findByEmail('admin@example.com');
$repository->findByName('John');
$repository->findByNameAndAge('John', 18);

// ==============================================

/**
 * Реализуйте динамические методы findAllBy<FieldName>.
 * Название MyFieldNameId должно преобразовываться в my_field_name_id.
 * Методы должны возвращать sql запрос. 
 * Используйте метод where, уже написанный для Repository.
 * Бросайте исключение WrongFinderNameException, если название метода не соответствует шаблону /findAllBy([A-Z].*)/.
 * 
 * Подсказки
 *   Для работы с регулярными выражениями используйте функцию preg_match_all.
 */

interface RepositoryInterface
{
    public function __construct($tableName);
}

interface RepositoryExceptionInterface
{
}

class WrongFinderNameException extends \Exception implements RepositoryExceptionInterface
{
}

class Repository implements RepositoryInterface
{
    // BEGIN (write your solution here)
    private $tableName = '';
    
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }
    
    public function __call($method, $params)
    {
        preg_match_all("/findAllBy([A-Z].*)/", $method, $fieldNames);
        
        if (isset($fieldNames[1]) && empty($fieldNames[1])) {
            throw new WrongFinderNameException("Wrong field name.");
        }
        
        $fieldName = implode('', $fieldNames[1]);
        $fieldName = $this->transformFieldName($fieldName);
        $param = $params[0];
        
        return $this->where($fieldName, $param);
    }
    
    private function transformFieldName($fieldName)
    {
        $arr = str_split($fieldName);
        
        return strtolower(
            implode('', 
                array_map(function($key, $char) {
                    return (ord($char) < 97 && $key != 0) ? '_' . $char : $char;
                }, array_keys($arr), array_values($arr))
            )
        );
    }
    // END

    public function where($fieldName, $value)
    {
        $format = "select * from %s where %s = '%s'";
        return sprintf(
            $format,
            $this->_escape($this->tableName),
            $this->_escape($fieldName),
            $this->_escape($value)
        );
    }

    private function _escape($value)
    {
        // NOTE: we must to implement escape logic over here in real world
        return $value;
    }
}

class Test extends \PHPUnit_Framework_TestCase
{
    public function testRightWay()
    {
        $repo = new Repository('users');
        $expected = "select * from users where state = 'confirmed'";
        $actual = $repo->findAllByState('confirmed');
        $this->assertEquals($expected, $actual);
    }

    public function testRightWay2()
    {
        $repo = new Repository('photos');
        $expected = "select * from photos where owner_id = '4'";
        $actual = $repo->findAllByOwnerId(4);
        $this->assertEquals($expected, $actual);
    }

    public function testRightWay3()
    {
        $repo = new Repository('companies');
        $expected = "select * from companies where company_creator_name = 'john'";
        $actual = $repo->findAllByCompanyCreatorName('john');
        $this->assertEquals($expected, $actual);
    }

    public function testException()
    {
        $repo = new Repository('companies');
        try {
            $repo->undefinedMethod('john');
            $this->fail('An expected exception has not been raised.');
        } catch (RepositoryExceptionInterface $e) {
            $this->assertInstanceOf('App\WrongFinderNameException', $e);
        }
    }
}