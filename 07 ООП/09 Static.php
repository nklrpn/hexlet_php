<?php

/**
 * Один из способов работы с конфигурационными файлами - это динамическое определение типа файла на основе расширения и выбор соответствующего парсера. После парсинга данные преобразуются в единый вид, и из приложения работа с ними идет независимо от источника. Пример реализации:
 * 
 * $config = Config::factory("path/to/ini");
 * $config->getValue('host');
 * 
 * $config = Config::factory("path/to/xml");
 * $config->getValue('host');
 * Для простоты наша реализация работает только с плоскими конфигурационными файлами, то есть с key и value.
 * 
 * Config.php
 * Реализуйте статическую функцию factory у класса Config, 
 * которая на основе расширения файла выбирает правильный парсер, 
 * производит парсинг данных (см. интерфейсы) 
 * и возвращает инстанс класса Config.
 * 
 * Подсказки:
 * Для получения расширения файла есть функция pathinfo;
 * Чтобы создать свой собственный инстанс, можно писать new self()
 */

interface ConfigInterface
{
    public function __construct($fromType, array $data);
    public function getFromType();
    public function getValue($key);
}
 
class Config implements ConfigInterface
{
    private $data;
    private $fromType;

    // BEGIN (write your solution here)
    const MAPPING = [
        'ini' => 'App\IniConfigParser',
        'xml' => 'App\XmlConfigParser',
        'yml' => 'App\YamlConfigParser',
    ];

    public static function factory($filepath, array $options = [])
    {
        $extension = pathinfo($filepath, PATHINFO_EXTENSION);
        
        $parser = self::MAPPING[$extension];
        $data = $parser::parse($filepath, $options);
        
        return new self($extension, $data);
    }    
    // END

    public function __construct($fromType, array $data)
    {
        $this->fromType = $fromType;
        $this->data = $data;
    }

    public function getFromType()
    {
        return $this->fromType;
    }

    public function getValue($key)
    {
        return $this->data[$key];
    }
}

interface ConfigParserInterface
{
    public static function parse($filepath, array $options);
}

class IniConfigParser implements ConfigParserInterface
{
    public static function parse($filepath, array $options)
    {
        // it is just example, without real code
        return ['key' => 'value1'];
    }
}

class XmlConfigParser implements ConfigParserInterface
{
    public static function parse($filepath, array $options)
    {
        // it is just example, without real code
        return ['key' => 'value2'];
    }
}

class YamlConfigParser implements ConfigParserInterface
{
    public static function parse($filepath, array $options)
    {
        // it is just example, without real code
        return ['key' => 'value3'];
    }
}

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testFromXml()
    {
        $config = Config::factory('path/to/file.xml');
        $this->assertEquals('xml', $config->getFromType());
        $this->assertEquals('value2', $config->getValue('key'));
    }

    public function testFromIni()
    {
        $config = Config::factory('path/to/file.ini');
        $this->assertEquals('ini', $config->getFromType());
        $this->assertEquals('value1', $config->getValue('key'));
    }

    public function testFromYaml()
    {
        $config = Config::factory('path/to/file.yml');
        $this->assertEquals('yml', $config->getFromType());
        $this->assertEquals('value3', $config->getValue('key'));
    }
}