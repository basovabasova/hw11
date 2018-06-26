<?php

namespace hw11\classes;

class Order extends Basket
{
    public $name;

    public function __construct($name)
    {
        $this -> name = $name;
    }

    public function getName()
    {
        return $this -> name;
    }

    public function getBasket()
    {
        echo 'Ваш заказ:' . '<br>';
        echo $this -> name -> showBasket();
    }
}

