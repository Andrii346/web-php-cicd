<?php

declare(strict_types=1);

namespace App\Tasks;

class Rectangle
{
    public function __construct(
        public readonly float $width,
        public readonly float $height
    ) {}

    public function getPerimeter(): float
    {
        return 2 * ($this->width + $this->height);
    }

    public function getArea(): float
    {
        return $this->width * $this->height;
    }
}
