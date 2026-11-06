<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollComponent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'type',
    ];

    public function payrolls(): BelongsToMany
    {
        return $this->belongsToMany(Payroll::class, 'payroll_payroll_component')
            ->withPivot('amount')
            ->withTimestamps();
    }
}
