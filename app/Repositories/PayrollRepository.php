<?php

declare(strict_types=1);

namespace App\Repositories;

class PayrollRepository
{
    private static array $payrolls = [
        [
            'id' => 1,
            'employee_id' => 101,
            'employee_name' => 'Іваненко Іван Іванович',
            'period' => '2026-09',
            'base_salary' => 25000.00,
            'worked_days' => 22,
            'bonus' => 3000.00,
            'tax_amount' => 5460.00,
            'net_salary' => 22540.00,
            'status' => 'paid',
        ],
        [
            'id' => 2,
            'employee_id' => 102,
            'employee_name' => 'Петренко Ольга Василівна',
            'period' => '2026-09',
            'base_salary' => 32000.00,
            'worked_days' => 20,
            'bonus' => 5000.00,
            'tax_amount' => 7215.00,
            'net_salary' => 29785.00,
            'status' => 'calculated',
        ],
    ];

    public static function all(): array
    {
        return self::$payrolls;
    }

    public static function find(int $id): ?array
    {
        foreach (self::$payrolls as $record) {
            if ($record['id'] === $id) {
                return $record;
            }
        }

        return null;
    }

    public static function create(array $data): array
    {
        $newPayroll = array_merge(
            ['id' => count(self::$payrolls) + 1],
            $data
        );

        self::$payrolls[] = $newPayroll;

        return $newPayroll;
    }
}
