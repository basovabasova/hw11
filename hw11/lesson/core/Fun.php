<?php
class Fun 
{
    public $property;
    
    public function __construct($property)// метод __construct(). Событие - момент создания объекта
    {
        //содержимое конструктора
        $this -> property = $property;
        echo 'создан объект класса Fun' . '<br>';
    }
}