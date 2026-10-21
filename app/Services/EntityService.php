<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\LoggerInterface;
use App\Models\AbstractEntity;
use Exception;

class EntityService
{
    public function __construct(
        private LoggerInterface $logger
    ) {}

    public function processEntity(AbstractEntity $entity): void
    {
        $this->logger->log('Опрацювання сутності: '.$entity->getDetails());
    }

    public function calculateNetSalary(float $grossSalary, float $totalTaxPercent): float
    {
        $this->logger->log("Розрахунок зарплати: Брутто = {$grossSalary}, Податки = {$totalTaxPercent}%");
        $taxAmount = $grossSalary * ($totalTaxPercent / 100);

        return round($grossSalary - $taxAmount, 2);
    }

    public function applyDiscount(float $price, float $discount): float
    {
        if ($discount < 0 || $discount > 100) {
            $this->logger->log("ПОМИЛКА: Спроба передати некоректну знижку ({$discount}%)");
            throw new Exception("Неприпустиме значення знижки: {$discount}%. Значення має бути в межах від 0 до 100.");
        }

        return round($price - ($price * ($discount / 100)), 2);
    }
}
