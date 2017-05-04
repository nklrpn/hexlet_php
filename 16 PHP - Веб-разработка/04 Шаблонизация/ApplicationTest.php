<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testRender()
    {
        $result = file_get_contents("http://localhost:8080/");
        $this->assertRegExp('/<h1>hello, world!<\/h1>/', $result);
    }

    public function testRenderWithParams()
    {
        $result = file_get_contents("http://localhost:8080/about");
        $this->assertRegExp('/<h1>hexlet\.io<\/h1>/', $result);
    }
}