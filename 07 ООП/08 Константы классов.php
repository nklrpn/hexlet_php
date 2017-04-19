<?php

class MarkdownParser
{
    const VERSION = '0.9.1';
    
    public function getVersion()
    {
        return self::VERSION;
    }
}

echo MarkdownParser::VERSION;

// ==============================

/**
 * Создайте класс Markdown.
 * Создайте у класса константу OUTPUT_FORMAT со значением html.
 * Создайте метод getOutputFormat, который возвращает значение константы.
 */
 
class Markdown
{
    // BEGIN (write your solution here)
    const OUTPUT_FORMAT = 'html';
    
    public function getOutputFormat()
    {
        return self::OUTPUT_FORMAT;
    }
    // END
}