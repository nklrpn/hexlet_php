<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testCompany()
    {
        $result = file_get_contents("http://localhost:8080/companies");
        $this->assertEquals('companies list', strtolower($result));
    }

    public function testCompanies()
    {
        $opts = ['http' =>
            [
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                /* 'content' => $postdata */
            ]
        ];

        $context = stream_context_create($opts);

        $result = file_get_contents("http://localhost:8080/companies", false, $context);
        $this->assertEquals('company was created', strtolower($result));
    }
}
