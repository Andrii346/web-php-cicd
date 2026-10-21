<?php

declare(strict_types=1);

namespace App\Core;

class Database
{
    private static ?Database $instance = null;

    private function __construct()
    {
        // Приватний конструктор унеможливлює створення через new Database()
    }

    private function __clone()
    {
        // Заборона клонування
    }

    public function __wakeup()
    {
        // Заборона десеріалізації
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getConnectionStatus(): string
    {
        return 'Підключення до БД створено';
    }
}
