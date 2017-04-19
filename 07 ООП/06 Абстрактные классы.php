<?php

/**
 * Реализуйте абстрактный класс Mailer согласно интерфейсу MailerInterface. 
 * Реализуйте в нем методы setVar (для сохранения пары "ключ-значение") 
 * и getAllVars (для получения массива всех сохраненных пар).
 */

interface MailerInterface
{
    public function setVar($key, $value);
    public function getAllVars();
    public function render();
}
 
// BEGIN (write your solution here)
abstract class Mailer implements MailerInterface
{
    protected $vars = [];
    
    public function setVar($key, $value)
    {
        $this->vars[$key] = $value;
    }
    
    public function getAllVars()
    {
        return $this->vars;
    }
}
// END

class FastMailer extends Mailer
{
    public function render()
    {
        $data = json_encode($this->getAllVars());
        return "<html>{$data}</html>";
    }
}