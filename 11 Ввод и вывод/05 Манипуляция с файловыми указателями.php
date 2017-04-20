<?php

$data = 'ehu';

$handle = fopen('temp', 'wb');
fwrite($handle, $data);

echo ftell($handle) . PHP_EOL; // 3
fseek($handle, 0); // rewind($handle);
echo ftell($handle) . PHP_EOL; // 0

// SplFileObject

/**
 * Класс Db представляет собой простую реализацию NoSQL базы данных, 
 * основанной на файлах. Она обладает очень простым интерфейсом. 
 * Метод get принимает на вход ключ (любая строка) и возвращает значение этого ключа. 
 * Метод set принимает на вход ключ и значение (любая строка).
 * 
 * Ограничения:
 *   Максимальный размер ключа 8 байт.
 *   Максимальный размер значения 100 байт.
 * 
 * Пример:
 *   $db = new Db($filepath);
 *   $db->set('key', 'value');
 *   'value' == $db->get('key');
 * 
 * Реализуйте логику работы этого класса используя смещения внутри файла.
 * 
 * Если файла базы не существует, то он должен создаваться в конструкторе
 * Если ключа не существует, то операция get должна выкидывать исключение Db\NotFoundException
 */

class Db
{
    const KEY_LENGTH = 8;
    const VALUE_LENGTH = 100;
    // BEGIN (write your solution here)
    protected $file;
    
    protected $data = [];
    
    public function __constructor($file)
    {
        $this->file = $file;
        
        if (!file_exists($file)) {
            file_put_contents($file);
        }
    }
    
    public function get($key)
    {
        if (!array_key_exists($key, $this->data)) {
            throw new Db\NotFoundException("Key {$key} not found");
        }

        return $this->data[$key];
    }
    
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }
    
    /* TEACHER'S SOLUTION */
    const ZERO = '\0';

    private $db;

    public function __construct($file)
    {
        if (!file_exists($file)) {
            touch($file);
        }
        
        $this->db = new \SplFileObject($file, 'r+');
    }

    public function get($key)
    {
        $this->db->rewind();
        
        while (!$this->db->eof()) {
            $possibleKey = trim($this->db->fread(self::KEY_LENGTH), self::ZERO);
            
            if ($key === $possibleKey) {
                return trim($this->db->fread(self::VALUE_LENGTH), self::ZERO);
            }
        }

        throw new Db\NotFoundException("'$key' is not exists");
    }

    public function set($key, $value)
    {
        $this->db->rewind();
        
        while (!$this->db->eof()) {
            $possibleKey = trim($this->db->fread(self::KEY_LENGTH), self::ZERO);
        
            if ($key === $possibleKey) {
                $this->write($value, self::VALUE_LENGTH);
                return;
            }
            
            $this->db->fread(self::VALUE_LENGTH);
        }

        $this->write($key, self::KEY_LENGTH);
        $this->write($value, self::VALUE_LENGTH);
    }

    private function write($data, $length)
    {
        $zeroLength = $length - strlen($data);
        
        $this->db->fwrite($data);
        $this->db->fwrite(str_repeat(self::ZERO, $zeroLength));
    }
    // END
}

class NotFoundException extends \Exception
{
}

class DbTest extends TestCase
{
    private $db;

    public function setUp()
    {
        $file = '/tmp/db.dblite';
        if (file_exists($file)) {
            unlink($file);
        }
        $this->db = new Db($file);
    }

    public function testDb()
    {
        $this->db->set('key', 'value');
        $this->assertEquals('value', $this->db->get('key'));

        $this->db->set('key2', 'value2');
        $this->assertEquals('value2', $this->db->get('key2'));

        $this->db->set('key', 'another value');
        $this->assertEquals('another value', $this->db->get('key'));
    }

    public function testBug()
    {
        $this->db->set('one', 'two');
        $this->db->set('two', 'some data');
        $this->db->set('three', 'another data');
        $this->assertEquals('two', $this->db->get('one'));
    }

    /**
     * @expectedException App\Db\NotFoundException
     */
    public function testGetException()
    {
        $this->db->get('key');
    }
}
