<?php

namespace hw11\classes;

abstract class SuperClassProduct
{
    public $name; 
    public $type;
    private $price;
    public $weight;

    public function __construct($name, $type, $price, $weight)
    {
        $this -> name = $name;
        $this -> type = $type;
        $this -> price = $price;
        $this -> weight = $weight;
    }
    
    public function getProperty($property)
    {
        return $this -> $property;
    }
    
    public function setProperty($property, $value) {
        $this -> $property = $value;
    }

    public function getDiscount() 
    {
        if (($this -> type == 'home' && $this -> weight > 10) || ($this -> type !== 'home')) {
            return $this -> price * 0.1;
        } else {
            return 0;
        }
    }

    public function getDelivery()
    {
        if ($this -> getDiscount() > 0) {
            return 300;
        } else {
            return 250;
        }
    }

    public function getPrice()
    {
        return $this -> price - $this -> getDiscount();
    }

    public function getAllPrice()
    {
        return $this -> getPrice() + $this -> getDelivery();
    }
    
    public function getFullDescription()
    {
        $this -> getDescription(); 
        echo "Цена: {$this -> getPrice()} руб. ";
    }
    
    abstract public function getDescription();
}