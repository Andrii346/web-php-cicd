<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'  => fake()->firstName(),
            'last_name'   => fake()->lastName(),
            'email'       => fake()->unique()->safeEmail(),
            'tax_number'  => fake()->unique()->numerify('##########'),
            'position'    => fake()->randomElement(['Бухгалтер', 'PHP Розробник', 'Системний аналітик', 'HR Менеджер']),
            'base_salary' => fake()->randomFloat(2, 18000, 65000),
            'is_active'   => true,
        ];
    }
}
