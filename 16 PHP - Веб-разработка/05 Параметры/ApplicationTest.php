<?php

namespace App\Tests;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testDefault()
    {
        $actual = file_get_contents('http://localhost:8080');
        $expected = [
            ['id' => 4, 'age' => 15],
            ['id' => 3, 'age' => 28],
            ['id' => 8, 'age' => 3],
            ['id' => 1, 'age' => 23]
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), $actual);
    }

    public function testSort1()
    {
        $actual = file_get_contents('http://localhost:8080?sort=id+asc');
        $expected = [
            ['id' => 1, 'age' => 23],
            ['id' => 3, 'age' => 28],
            ['id' => 4, 'age' => 15],
            ['id' => 8, 'age' => 3]
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), $actual);
    }

    public function testSort2()
    {
        $actual = file_get_contents('http://localhost:8080?sort=age+desc');
        $expected = [
            ['id' => 3, 'age' => 28],
            ['id' => 1, 'age' => 23],
            ['id' => 4, 'age' => 15],
            ['id' => 8, 'age' => 3]
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), $actual);
    }

    public function testSort3()
    {
        $actual = file_get_contents('http://localhost:8080?notsort=value');
        $expected = [
           ['id' => 4, 'age' => 15],
           ['id' => 3, 'age' => 28],
           ['id' => 8, 'age' => 3],
           ['id' => 1, 'age' => 23]
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), $actual);
    }
}
