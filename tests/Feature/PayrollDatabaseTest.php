<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayrollComponent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PayrollDatabaseTest extends TestCase
{
    use RefreshDatabase; // Обов'язково: запускає міграції перед тестами

    public function test_can_fetch_payrolls_with_relations(): void
    {
        $employee = Employee::factory()->create();
        $payroll = Payroll::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $response = $this->withHeaders(['X-App-Client' => 'TestRunner'])
            ->getJson('/payrolls');

        $response->assertStatus(200);
    }
}