<?php

$file = __FILE__;

$lines = file($file);


$content = file_get_contents($file);


$handle = fopen($file, 'rb');
if ($handle) {
    try {
        $contents = fread($handle, filesize($file));
    } finally {
        fclose($handle);
    }
}


$handle = fopen($file, 'rb');
if ($handle) {
    try {
        while (!feof($handle)) {
            echo fgets($handle, 1024);
        }
    } finally {
        fclose($handle);
    }    
}


$handle = fopen($file, 'rb');
if ($handle) {
    try {
        /* javier   argonaut    pe */
        /* hiroshi  sculptor    jp */
        /* robert   slacker     us */
        /* luigi    florist     it */
        while ($userinfo = fscanf($handle, "%s\t%s\t%s\n")) {
            list($name, $profession, $countrycode) = $userinfo;
        }
    } finally {
        fclose($handle);
    }    
}


$file = new \SplFileInfo("file.txt");
while (!$file->eof()) {
    echo $file->fgets();
}

foreach ($file as $linenum => $content) {
    printf("line %d: %s", $linenum, $content);
}

$linesTenTwentyIterator = new \LimitIterator(
    $file,
    9, // start at line 10
    10 // iterate 10 lines
);
foreach ($linesTenTwentyIterator as $line) {
    echo $line; // outputs line 10 to 20
}


/**
 * Реализуйте функцию grep, принимающую на вход два параметра: 
 * подстроку для сопоставления и шаблон в формате glob, по которому будет происходить поиск.
 * 
 * Функция должна вернуть список всех строк файлов, 
 * в которых содержится подстрока. 
 * Поиск должен производиться по всем файлам переданного шаблона.
 * 
 * Пример:
 * 
 * sizeof(grep('test', './*')); // 3
 */

function grep($string, $path)
{
    // BEGIN (write your solution here)
    $res = [];
    
    $files = glob($path);
    
    foreach ($files as $file) {
        $handle = fopen($file, 'rb');
        
        if ($handle) {
            try {
                while (!feof($handle)) {
                    $line = fgets($handle);
                    
                    if (strpos($line, $string) !== false) {
                        $res[] = $line;
                    }
                }
            } finally {
                fclose($handle);
            }
        }
    }
    
    return $res;
    
    /* TEACHER'S SOLUTION */
    $iterator = new \GlobIterator($path);
    $lines = [];
    foreach ($iterator as $path => $info) {
        if (!$info->isFile()) {
            continue;
        }
        $content = file($path);
        foreach ($content as $line) {
            if (false !== strpos($line, $string)) {
                $lines[] = $line;
            }
        }

    }

    return $lines;
    // END
}


class FileUtilsTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testCd($actual, $string, $path)
    {
        $this->assertCount($actual, grep($string, $path));
    }

    public function additionProvider()
    {
        return [
            [3, 'convert', './*'],
            [2, 'test', './*'],
        ];
    }
}