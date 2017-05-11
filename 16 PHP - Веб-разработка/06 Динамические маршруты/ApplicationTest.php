<?php

namespace App\Tests;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    private $app;

    public function testUsers()
    {
        $id = rand(1, 100);
        $actual = file_get_contents("http://localhost:8080/users/{$id}");
        $expected = ['id' => $id];

        $this->assertEquals($expected, json_decode($actual, true));
    }

    public function testUserArticles()
    {
        $userId = rand(1, 100);
        $id = rand(1, 100);
        $actual = file_get_contents("http://localhost:8080/users/{$userId}/articles/{$id}");
        $expected = ['userId' => $userId, 'id' => $id];

        $this->assertEquals($expected, json_decode($actual, true));
    }
}
