<?php

namespace App\Http\Requests\PayrollComponent;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePayrollComponentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:150', 'unique:payroll_components,name'],
            'code' => ['required', 'string', 'min:2', 'max:50', 'unique:payroll_components,code'],
            'type' => ['required', 'in:allowance,deduction'],
        ];
    }
}
