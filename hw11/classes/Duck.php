<?php

namespace hw11\classes;

class Duck extends SuperClassProduct implements DuckInterface
{
    public function __construct($type, $name, $price, $weight) 
    {
        parent:: __construct($name, $type, $price, $weight);      
    }
    
    public function getDescription()
    {
        if ($this -> type == 'home') {
            echo "{$this -> name} весит примерно {$this -> weight} кг." . '<br>';
        }
        else {
            echo "{$this -> name} - молодец!" . '<br>';
        }
    }

    public function getQuestion()
    {
        return 'Кря!' . '<br>';
    }

    public function isAlive()
    {
        if ($this -> getQuestion()) {
            return true;
        }
    }
}