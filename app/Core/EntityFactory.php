<?php

declare(strict_types=1);

namespace App\Core;

use App\Models\AbstractEntity;
use App\Models\Product;
use App\Models\User;
use InvalidArgumentException;

class EntityFactory
{
    public static function createEntity(string $type, array $data): AbstractEntity
    {
        return match (strtolower($type)) {
            'user' => new User(
                id: (string) ($data['id'] ?? uniqid()),
                createdAt: (string) ($data['createdAt'] ?? date('Y-m-d H:i:s')),
                name: (string) ($data['name'] ?? 'Гість'),
                email: (string) ($data['email'] ?? 'guest@example.com'),
                role: (string) ($data['role'] ?? 'Бухгалтер')
            ),
            'product' => new Product(
                id: (string) ($data['id'] ?? uniqid()),
                createdAt: (string) ($data['createdAt'] ?? date('Y-m-d H:i:s')),
                title: (string) ($data['title'] ?? 'Невідомий товар'),
                price: (float) ($data['price'] ?? 0.0),
                stock: (int) ($data['stock'] ?? 0)
            ),
            default => throw new InvalidArgumentException("Невідомий тип сутності: {$type}"),
        };
    }
}
