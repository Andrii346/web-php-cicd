<?php

namespace App\Http\Requests\Employee;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'  => ['required', 'string', 'min:2', 'max:100'],
            'last_name'   => ['required', 'string', 'min:2', 'max:100'],
            'email'       => ['required', 'email', 'unique:employees,email'],
            'tax_number'  => ['required', 'string', 'size:10', 'unique:employees,tax_number'],
            'position'    => ['required', 'string', 'min:2', 'max:150'],
            'base_salary' => ['required', 'numeric', 'min:7100'],
        ];
    }
}
