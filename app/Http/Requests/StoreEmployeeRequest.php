<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_id'      => 'required|exists:accounts,id',
            'designation_id'  => 'nullable|exists:designations,id',
            'depertment_id'   => 'required|exists:departments,id',
            'first_name'      => 'required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:employees,email',
            'is_active'       => 'boolean',
        ];
    }
}
