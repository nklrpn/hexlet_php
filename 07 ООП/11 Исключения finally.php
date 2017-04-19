<?php

namespace Theory;

$handle = fopen($filepath, "r");

try {
    $data = fread($handle, filesize($filepath));
    // NOTE: to do smth
} finally {
    fclose($handle);
}

// =================================

/**
 * FileReader - это небольшая абстракция, представляющая собой интерфейс для чтения файла.
 * 
 * namespace App\FileReader;
 * 
 * interface FileReader
 * {
 *     public function read();
 *     public function close();
 * }
 * Поведение у FileReader следующее. 
 * Вызов метода read() возвращает содержимое файла, связанного с данным объектом FileReader. 
 * Если в процессе чтения файла возникает ошибка, то будет брошено исключение FileReaderException. 
 * Так как FileReader использует ресурсы системы, после чтетия файла, его необходимо закрыть. 
 * Не зависимо от того была ошибка при чтении или нет. 
 * Для этого у FileReader нужно вызвать метод close().
 * 
 * Solution.php
 * Допишите функцию read. 
 * Она должна читать данные из $fileReader->read() и вызывать соответствующие функции с результатом чтения: 
 * в случае если, данные из FileReader прочитаны успешно, 
 * она должна вызывать $onSuccess, передав данные в качестве аргумента, 
 * а в случае если при чтении возникла ошибка FileReaderException, 
 * функция должна вызвать $onError, передав исключение в качестве аргумента. 
 * При этом $fileReader после чтения должен быть закрыт и в случае успеха и в случае ошибки.
 */

function read(FileReader $fileReader, callable $onSuccess, callable $onError)
{
  // BEGIN (write your solution here)
  try {
    $data = $fileReader->read();
    $onSuccess($data);
  } catch (FileReaderException $e) {
    $onError($e);
  } finally {
    $fileReader->close();
  }
  // END
}

class SolutionTest extends TestCase
{
  private $isInvoked = false;

  public function testOnGoodFileReader()
  {
    $goodFile = new \App\FileReader\GoodFileReader("goodFile");

    $onSuccess = function ($content) {
      $this->assertEquals("some good content", $content);
      $this->isInvoked = true;
    };
    $onError = function ($exception) {
      $this->fail("unexpected exception - " . $exception);
    };
    \App\read($goodFile, $onSuccess, $onError);
    $this->assertTrue($this->isInvoked, 'onSuccess is not called');

    $this->assertTrue($goodFile->isClosed(), 'FileReader must be closed');
  }

  public function testOnBadFileReader()
  {
    $badFile = new \App\FileReader\BadFileReader("badFile");

    $onSuccess = function () {
      $this->fail();
    };
    $onError = function ($exception) {
      $this->assertInstanceOf(\App\FileReader\FileReaderException::class, $exception);
      $this->assertEquals("File badFile could not be read", $exception->getMessage());
      $this->isInvoked = true;
    };
    \App\read($badFile, $onSuccess, $onError);
    $this->assertTrue($this->isInvoked, 'onError is not called');

    $this->assertTrue($badFile->isClosed(), 'FileReader must be closed');
  }
}
