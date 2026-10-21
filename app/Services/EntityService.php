<?php

declare(strict_types=1);

namespace App\Services;

use Exception;

class EntityService
{
    public function calculateNetSalary(float $grossSalary, float $totalTaxPercent): float
    {
        $taxAmount = $grossSalary * ($totalTaxPercent / 100);

        return round($grossSalary - $taxAmount, 2);
    }

    /**
     * Застосування податкової соціальної пільги/знижки
     *
     * @throws Exception
     */
    public function applyDiscount(float $price, float $discount): float
    {
        if ($discount < 0 || $discount > 100) {
            throw new Exception("Неприпустиме значення знижки: {$discount}%. Значення має бути в межах від 0 до 100.");
        }

        return round($price - ($price * ($discount / 100)), 2);
    }
}
