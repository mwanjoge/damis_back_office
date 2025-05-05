<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'embassy_id'     => 'nullable|exists:embassies,id',
            'name'           => 'required|string|max:255|unique:countries,name,' . $this->route('country')->id,
            'code'           => 'nullable|string|max:255|unique:countries,code,' . $this->route('country')->id,
            'phone_code'     => 'nullable|string|max:255',
            'currency'       => 'nullable|string|max:255',
            'currency_code'  => 'nullable|string|max:255',
            'synced'         => 'boolean',
        ];
    }
}
