<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'period',
        'base_salary',
        'worked_days',
        'bonus',
        'tax_amount',
        'net_salary',
        'status',
        'attachment_path',
    ];

    protected $casts = [
        'base_salary' => 'float',
        'worked_days' => 'integer',
        'bonus'       => 'float',
        'tax_amount'  => 'float',
        'net_salary'  => 'float',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)->withTrashed();
    }

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(PayrollComponent::class, 'payroll_payroll_component')
            ->withPivot('amount')
            ->withTimestamps();
    }
}