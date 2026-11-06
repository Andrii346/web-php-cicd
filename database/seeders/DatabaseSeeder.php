<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayrollComponent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $components = collect([
            ['name' => 'Премія за KPI', 'code' => 'KPI_BONUS', 'type' => 'allowance'],
            ['name' => 'Індексація ЗП', 'code' => 'INDEXATION', 'type' => 'allowance'],
            ['name' => 'Навчальна відпустка', 'code' => 'STUDY_LEAVE', 'type' => 'allowance'],
            ['name' => 'Профспілковий внесок', 'code' => 'UNION_FEE', 'type' => 'deduction'],
        ])->map(fn ($item) => PayrollComponent::firstOrCreate(['code' => $item['code']], $item));

        Employee::factory(5)->create()->each(function (Employee $employee) use ($components) {
            $payroll = Payroll::factory()->create([
                'employee_id' => $employee->id,
                'period' => '2026-10',
                'base_salary' => $employee->base_salary,
            ]);

            $payroll->components()->attach($components->random()->id, [
                'amount' => fake()->randomFloat(2, 500, 3000),
            ]);
        });
    }
}
