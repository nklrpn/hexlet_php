<?php

namespace Theory\Solution;

function makeFolderForUser($userId, $rootDir = null) {
    $directory = ($rootDir ? $rootDir : sys_get_temp_dir()) . DIRECTORY_SEPARATOR . $userId;
    
    if (!file_exists($directory)) {
        mkdir($directory, 0700, true);
    }
}


/**
 * Плохие тесты с побочными эффектами
 */
class BadTestSolution extends \PHPUnit_FRamework_TestCase
{
    private $directory;
    private $userId;
    
    protected function setUp()
    {
        $this->userId = 5;
        $this->tmpdir = sys_get_temp_dir();
        $this->directory = $this->tmpdir . DIRECTORY_SEPARATOR . $this->userId;
    }
    
    public function testDirectoryIsCreated()
    {
        makeFolderForUser($this->userId);
        $this->assertTrue(file_exists($this->directory));
    }
}

/**
 * Хорошие тесты с побочными эффектами
 */
class GoodTestSolution extends \PHPUnit_Framework_TestCase
{
    private $directory;
    private $userId;
    
    protected function setUp()
    {
        if (file_exists($this->directory)) {
            rmdir($this->directory);
        }
        
        $this->userId = 5;
        $this->tmpdir = sys_get_temp_dir();
        $this->directory = $this->tmpdir . DIRECTORY_SEPARATOR . $this->userId;
    }
    
    public function testDirectoryIsCreated()
    {
        $this->assertFalse(file_exists($this->directory));
        
        makeFolderForUser($this->userId);
        $this->assertTrue(file_exists($this->directory));
    }
    
    protected function tearDown()
    {
        if (file_exists($this->directory)) {
            rmdir($this->directory);
        }
    }
}


/**
 * Отличные тесты без побочных эффектов
 */
namespace Theory;

require_once 'Solution.php';

use org\bovigo\vfs\vfsStream;

use function Theory\Solution\makeFolderForUser;

class SolutionVirtualFsTest extends \PHPUnit_Framework_TestCase
{
    private $directory;
    private $userId;
    private $root;
    
    protected function setUp()
    {
        $this->root = vfsStream::setup('dir');
        
        $this->userId = 10;
        $this->directory = vfsStream::url('dir') . DIRECTORY_SEPARATOR . $this->userId;
    }
    
    public function testDirectoryIsCreated()
    {
        $folder = (string) $this->userId;
        $this->assertFalse($this->root->hasChild($folder));
        
        makeFolderForUser($this->userId, vfsStream::url('dir'));
        $this->assertTrue($this->root->hasChild($folder));
    }
}


/**
 * Напишите тесты на функцию mkdirs, которая рекурсивно создает директории для переданного пути
 */

namespace App;

require getenv('COMPOSER_HOME') . '/vendor/autoload.php';

// BEGIN (write your solution here)
use org\bovigo\vfs\vfsStream;
// END

class TestSolution extends \PHPUnit_Framework_TestCase
{
    // BEGIN (write your solution here)
    public function testMkdirs()
    {
        $root = vfsStream::setup('root');

        mkdirs(vfsStream::url('root') . '/test');
        $this->assertTrue($root->hasChild('test'));

        mkdirs(vfsStream::url('root') . '/test/inner');
        $this->assertTrue($root->hasChild('test/inner'));
    }
    // END
}

