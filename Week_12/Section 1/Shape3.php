<?php

interface Shape3
{
    public function calculateArea();
}

interface Color
{
    public function getColor();
}

class Circle implements Shape3, Color
{
    private $radius;
    private $color;

    public function __construct($radius, $color)
    {
        $this->radius = $radius;
        $this->color = $color;
    }

    public function calculateArea()
    {
        return pi() * pow($this->radius, 2);
    }

    public function getColor()
    {
        return $this->color;
    }
}

// Create an instance of the Circle class
$circle = new Circle(5, "Blue");

// Output the area and color of the circle
echo "Area of Circle: " . $circle->calculateArea() . "<br>";
echo "Color of Circle: " . $circle->getColor() . "<br>";
