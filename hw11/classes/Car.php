<?php

namespace hw11\classes;

class Car extends SuperClassProduct implements CarInterface
{
    public $color;

    public function __construct($color, $name, $type, $price, $weight) 
    {
        parent:: __construct($name, $type, $price, $weight);
        $this -> color = $color;
    }

    public function isHighSpeed()
    {
        if ($this -> name !== 'Ferrari') {
            return false;
        } else {
            return true;
        }
    }

    public function getDescription()
    {
        echo "{$this -> name} цвета {$this -> color}. ";
    }
}