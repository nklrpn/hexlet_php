<?php

namespace Theory;

class DynamicProps
{
    private $data = [];
    
    public $declared = 1;
    private $hidden =2;
    
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    
    public function __get($name)
    {
        return $this->data[$name];
    }
    
    public function getHidden()
    {
        return $this->hidden;
    }
    
    /* public function __isset(); */
    /* public function __unset(); */
}

$obj = new DynamicProps();
$obj->customKey = 'value';

echo $obj->customKey, PHP_EOL;
echo $obj->declared, PHP_EOL;
echo $obj->getHidden(), PHP_EOL;

// ====================================

/**
 * Создайте класс-обертку над ассоциативным массивом. 
 * Назовите его DynamicProps. 
 * Он должен принимать в конструктор ассоциативный массив.
 * 
 * Реализуйте доступ к значениям этого массива через __get.
 * Реализуйте установку значений через __set.
 * Реализуйте проверку на существования ключа через __isset.
 * Реализуйте удаление ключа через __unset.
 * При попытке обратиться через __set или __get к динамическому свойству, 
 * для которого нет ключа в массиве, 
 * необходимо выбрасывать исключение DynamicPropsUndefinedProp.
 */

class DynamicProps
{
    private $data = [];
    
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function __set($key, $value)
    {
        if (!array_key_exists($key, $this->data)) {
            throw new DynamicPropsUndefinedProp("{$key} is undefined");
        }
        
        $this->data[$key] = $value;
    }
    
    public function __get($key)
    {
        if (!array_key_exists($key, $this->data)) {
            throw new DynamicPropsUndefinedProp("{$key} is undefined");
        }
        
        return $this->data[$key];
    }
    
    public function __isset($key)
    {
        return array_key_exists($key, $this->data);
    }
    
    public function __unset($key)
    {
        unset($this->data[$key]);
    }
} 