<?php

namespace hw11\classes;

class TV extends SuperClassProduct implements TvInterface
{
    public $screen;

    public function __construct($name, $type, $screen, $price, $weight)
    {
        parent::__construct($name, $type, $price, $weight);
        $this -> screen = $screen; 
    }

    public function setYear($year)
    {
        $this -> year = $year;
        return $this;
    }

    public function getDescription()
    {
        echo "Телевизор типа {$this -> type}, {$this -> name}, диагональ: {$this -> screen} дюйма. ";
    }
}