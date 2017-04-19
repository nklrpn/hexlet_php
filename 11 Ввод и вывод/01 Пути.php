<?php
/**
 * Реализуйте функцию cd, принимающую на вход два параметра: текущую директорию и путь для перехода. Функция должна вернуть директорию, в которую необходимо перейти.
 * 
 * Пример использования:
 *  cd('/current/path', '/etc'); // /etc
 *  cd('/current/path', '.././anotherpath'); // /current/anotherpath
 * 
 * Правила перехода
 * Если путь для перехода начинается с /, то он же и является конечным путем (так как абсолютный путь).
 *  .. - на уровень выше
 *  . - та же директория
 */
 
 function cd($current, $move)
{
    // BEGIN (write your solution here)
    if (strpos($move, DIRECTORY_SEPARATOR) === 0) {
        return $move;
    }

    $currentParts = explode(DIRECTORY_SEPARATOR, $current);
    $parts = explode(DIRECTORY_SEPARATOR, $move);
    
    $updatedParts = array_reduce($parts, function ($acc, $item) {
        switch ($item) {
            case '':
            case '.':
                return $acc;
            case '..':
                return array_slice($acc, 0, -1);
            default:
                $acc[] = $item;
                return $acc;
        }
    }, $currentParts);

    return implode(DIRECTORY_SEPARATOR, $updatedParts);
    // END
}

class FileUtilsTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testCd($actual, $current, $move)
    {
        $this->assertEquals($actual, cd($current, $move));
    }

    public function additionProvider()
    {
        return [
            ['/', '/current/path', '/'],
            ['/current', '/current/path', '..'],
            ['/current', '/current/path', '../'],
            ['/current', '/current', '.'],
            ['/current/anotherpath', '/current/path', '.././anotherpath'],
            ['/etc', '/current/path', '/etc'],
            ['/current/anotherpath/path', '/current/anotherpath', 'current/../path'],
        ];
    }
}
