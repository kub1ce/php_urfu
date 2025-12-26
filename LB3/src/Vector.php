<?php

namespace App;

class Vector
{
    private float $x;
    private float $y;

    public function __construct(float $x = 0, float $y = 0)
    {
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

    // длина вектора
    public function length(): float
    {
        return sqrt($this->x * $this->x + $this->y * $this->y);
    }

    // проверка на нулевой вектор
    public function isZero(): bool
    {
        // эпсилун из-за погрешности float
        return abs($this->x) < PHP_FLOAT_EPSILON && abs($this->y) < PHP_FLOAT_EPSILON;
    }

    // перпендикулярность другому вектору
    public function isPerpendicularTo(Vector $other): bool
    {
        // 2 vect _|_, if скалярн. * === 0
        $dotProduct = $this->x * $other->getX() + $this->y * $other->getY();
        return abs($dotProduct) < PHP_FLOAT_EPSILON;
    }

    // создание _|_ вектора
    public function getPerpendicular(): Vector
    {
        // x<->y + y*(-1)
        return new Vector(-$this->y, $this->x);
    }

    // инфо о векторе
    public function __toString(): string
    {
        return sprintf("Vector(%.2f, %.2f)", $this->x, $this->y);
    }

    // статик создание нулевого вектора
    public static function zero(): Vector
    {
        return new Vector(0, 0);
    }
}