<?php

namespace Hw11\lesson\Core;

class Test 
{
    public $property;
    
    public function __construct($property)// метод __construct(). Событие - момент создания объекта
    {
        //содержимое конструктора
        $this -> property = $property;
        echo 'создан объект класса Fun' . '<br>';
    }
}

const MY_CONST = 10; //не define() !

function myFunction() 
{
    echo "string";
}