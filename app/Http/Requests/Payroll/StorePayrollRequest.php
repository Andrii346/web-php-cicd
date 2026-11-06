<?php

namespace App\Http\Requests\Payroll;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePayrollRequest extends FormRequest
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
            'employee_id'         => ['required', 'integer', 'exists:employees,id'],
            'period'              => ['required', 'string', 'regex:/^\d{4}-(0[1-9]|1[0-2])$/'],
            'worked_days'         => ['required', 'integer', 'min:1', 'max:31'],
            'bonus'               => ['nullable', 'numeric', 'min:0'],
            'attachment'          => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'components'          => ['nullable', 'array'],
            'components.*.id'     => ['required_with:components', 'integer', 'exists:payroll_components,id'],
            'components.*.amount' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
