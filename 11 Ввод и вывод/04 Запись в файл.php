<?php

$file = __DIR__ . DIRECTORY_SEPARATOR . 'temp';
$data = "my data\n";

file_put_contents($file, $data); // FILE_APPEND

if (is_writable($file)) {
    $handle = fopen($file, 'ab'); // a+ c
    if ($handle) {
        try {
            fwrite($handle, $data);
            fwrite($handle, $data);
            /* fflush($handle); */
        } finally {
            fclose($handle);
        }
    }
}

$file = new \SplFileObject($file, 'ab');
$file->fwrite($data);

/**
 * Сериализация — процесс перевода какой-либо структуры данных в последовательность битов. 
 * Обратной к операции сериализации является операция десериализации (структуризации) — 
 * восстановление начального состояния структуры данных из битовой последовательности.
 * 
 * Функция serialize в php генерирует пригодное для хранения представление переменной. 
 * Это полезно для хранения или передачи значений PHP между скриптами без потери их типа и структуры. 
 * Для превращения сериализованной строки обратно в PHP-значение существует функция unserialize.
 * 
 * src/App/Serializer.php
 * Реализуйте функцию dump, которая принимает на вход имя файла и структуру данных. 
 * После чего она сериализует эту структуру и записывает в файл.
 * 
 * Реализуйте функцию load, которая принимает на вход имя файла. 
 * После этого она читает содержимое файла и проводит десериализацию.
 * 
 * Пример:
 *   Serializer\dump($file, $structure);
 *   $data = Serializer\load($file);
 *   $structure == $data;
 */

// BEGIN (write your solution here)
function dump($file, $data)
{
    $string = serialize($data);
    file_put_contents($file, $string);
}

function load($file)
{
    $data = file_get_contents($file);
        
    return unserialize($data);
}
// END


class SerializerTest extends TestCase
{
    private $file;

    public function setUp()
    {
        $this->file = tempnam(sys_get_temp_dir(), 'hexlet');
    }

    /**
     * @dataProvider additionProvider
     */
    public function testDump($structure)
    {
        \App\Serializer\dump($this->file, $structure);

        $data = unserialize(file_get_contents($this->file));
        $this->assertEquals($structure, $data);
    }

    /**
     * @dataProvider additionProvider
     */
    public function testLoad($structure)
    {

        $data = serialize($structure);
        file_put_contents($this->file, $data);

        $data = \App\Serializer\load($this->file);
        $this->assertEquals($structure, $data);
    }

    public function additionProvider()
    {
        return [
            [''],
            [null],
            [3],
            [23.3],
            [[1, 3 => 'sdf.2', '' => null]]
        ];
    }
}
