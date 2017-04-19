<?php

/**
 * Реализуйте генератор рандомных чисел представленный классом Random. Класс должен удовлетворять интерфейсу RandomInterface.
 * 
 * Пример использования:
 * 
 *   $seq = new Random(100);
 *   $result1 = $seq->getNext();
 *   $result2 = $seq->getNext();
 * 
 *   $this->assertNotEquals($result1, $result2);
 * 
 *   $seq->reset();
 * 
 *   $result21 = $seq->getNext();
 *   $result22 = $seq->getNext();
 * 
 *   $this->assertEquals($result1, $result21);
 *   $this->assertEquals($result2, $result22);
 * 
 * Простейший способ реализовать случайные числа это линейный конгруэнтный метод.
 */

interface RandomInterface
{
    
}

class Random implements RandomInterface
{
    
}