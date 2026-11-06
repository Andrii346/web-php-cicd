<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payroll>
 */
class PayrollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $base = fake()->randomFloat(2, 20000, 50000);
        $bonus = fake()->randomFloat(2, 0, 5000);
        $tax = round(($base + $bonus) * 0.195, 2);

        return [
            'employee_id' => Employee::factory(), 
            'period'      => fake()->randomElement(['2026-09', '2026-10', '2026-11']),
            'base_salary' => $base,
            'worked_days' => fake()->numberBetween(18, 22),
            'bonus'       => $bonus,
            'tax_amount'  => $tax,
            'net_salary'  => round(($base + $bonus) - $tax, 2),
            'status'      => 'calculated',
        ];
    }
}
