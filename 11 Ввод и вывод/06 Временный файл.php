<?php

$dir = sys_get_temp_dir(); // /tmp

$tmpfname = tempnam(sys_get_temp_dir(), "HEXLET");

$temp = tmpfile();
try {
    fwrite($temp, "my data");
    fseek($temp, 0);
    echo fread($temp, 1024);
} finally {
    fclose($temp);
}

/* SplTempFileObject */


/**
 * Реализуйте функцию tmpdir, принимающую на вход лямбда-функцию. tmpdir при этом должна создать временную директорию, а потом вызвать лямбду с переданным туда путем до директории. После вызова tmpdir должна удалить эту временную директорию. Функция tmpdir должна вернуть результат выполнения лямбда-функции.
 * 
 * Пример:
 *   $path = FileUtils\tmpdir(function ($dir) {
 *     is_dir($dir); // true
 *     return tempnam($dir, 'hexlet');
 *   });
 * 
 * file_exists($path); // false
 */
 
// BEGIN (write your solution here)
function tmpdir($func)
{
    $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid();
    mkdir($dir);
    
    try {
        return $func($dir);
    } finally {
        rrmdir($dir);
    }
}
// END

function rrmdir($dir)
{
    $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS), \RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($iterator as $filename => $fileInfo) {
        if ($fileInfo->isDir()) {
            rmdir($filename);
        } else {
            unlink($filename);
        }
    }
    rmdir($dir);
}


class FileUtilsTest extends TestCase
{
    public function testTmpdir1()
    {
        $exists = false;
        $path = tmpdir(function ($dir) use (&$exists) {
            $exists = is_dir($dir);
            return tempnam($dir, 'hexlet');
        });

        $this->assertTrue($exists);
        $this->assertFalse(file_exists($path));
    }

    public function testTmpdir2()
    {
        $exists = false;
        $isEmpty = tmpdir(function ($dir) use (&$exists) {
            $exists = is_dir($dir);
            return !(new \FilesystemIterator($dir))->valid();
        });

        $this->assertTrue($exists);
        $this->assertTrue($isEmpty);
    }
}
