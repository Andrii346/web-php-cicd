<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'tax_number',
        'position',
        'base_salary',
        'is_active',
    ];

    protected $casts = [
        'base_salary' => 'float',
        'is_active'   => 'boolean',
    ];

    public function payrolls(): HasMany
    {
        return $this->hasMany(Payroll::class);
    }
}
