<?php

declare(strict_types=1);

namespace App\Models;

class Product extends AbstractEntity
{
    public function __construct(
        string $id,
        string $createdAt,
        private string $title,
        private float $price,
        private int $stock
    ) {
        parent::__construct($id, $createdAt);
    }

    public function getDetails(): string
    {
        return "Товар #{$this->id}: {$this->title}, Ціна: {$this->price} грн, Залишок: {$this->stock} шт.";
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
