<?php

namespace Database\Factories;

use App\Models\PayrollComponent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PayrollComponent>
 */
class PayrollComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'code' => strtoupper(fake()->unique()->lexify('COMP_???')),
            'type' => fake()->randomElement(['allowance', 'deduction']),
        ];
    }
}
