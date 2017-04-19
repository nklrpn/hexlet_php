<?php

namespace Theory;

// class BaseMyLibException

function myReadFile($filepath)
{
    if (!file_exists($filepath)) {
        throw new \CustomLibException("File '${filepath}' doent't exist");
    }
}

function readFolder($filderPath)
{
    // NOTE: write logic over here
    return [myReadFile($folderPath)];
}

function tryReadFolder()
{
    try {
        $bodies = readFolder("path/to/filder");
        
        return $bodies;
    } catch (\LibException $e) {
        // echo $e->getMessage();
        logTo($e->getMessage());
        
        return [];
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

$result = tryReadFolder();
print_r($result);

// ========================================================================

/**
 * В данном упражнении вы реализуете небольшую библиотеку для работы с файлами. 
 * Ваша задача - написать функцию для чтения файла. 
 * Функция должна возвращать содержимое файла, имя которого передается в качестве аргумента. 
 * Если файл не существует - должно бросаться исключение.
 * 
 * src/File/Exceptions/FileException.php
 * Напишите класс исключения FileException. Унаследуйте его от базового класса Exception. 
 * Это будет базовое исключение, от которого будут наследоваться другие исключения в вашей библиотеке.
 * 
 * src/File/Exceptions/FileNotFoundException.php
 * Напишите класс исключения FileNotFoundException и унаследуйте его от FileException. 
 * Это исключение должно бросаться в случае, если файл не существует.
 * 
 * src/File/Solution.php
 * Напишите функцию read. Она должна принимать на вход имя файла и возвращать его содержимое. 
 * В случае, если файл не существует, она должна бросать исключение FileNotFoundException.
 * 
 * Подсказки:
 * Чтобы узнать существует файл или нет, используйте функцию file_exists
 * Чтобы получить содержимое файла, используйте функцию file_get_contents
 */

// FileException.php
namespace File\Exceptions;

// BEGIN (write your solution here)
class FileException extends \Exception
{
}
// END


// FileNotFoundException.php
namespace File\Exceptions;

// BEGIN (write your solution here)
class FileNotFoundException extends FileException
{
}
// END

// Solution.php
namespace File;

// BEGIN (write your solution here)
function read($filename)
{
    if (!file_exists($filename)) {
        throw new Exceptions\FileNotFoundException("File {$filename} does not exist");
    }
    
    return file_get_contents($filename);
}
// END
