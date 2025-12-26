<?php

namespace App;

class Point
{
    private float $x;
    private float $y;

    public function __construct(float $x = 0, float $y = 0) {
        $this->x = $x;
        $this->y = $y;
    }

    // геттеры
    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    // сеттеры
    public function setX(float $x): void
    {
        $this->x = $x;
    }

    public function setY(float $y): void
    {
        $this->y = $y;
    }

    // перенос точки
    public function translate(float $dx, float $dy): void
    {
        $this->x += $dx;
        $this->y += $dy;
    }

    // перенос точки вектором
    public function translateByVector(Vector $vector): void
    {
        $this->x += $vector->getX();
        $this->y += $vector->getY();
    }

    // инфо о точке
    public function __toString(): string
    {
        return sprintf("Point(%.2f, %.2f)", $this->x, $this->y);
    }
}