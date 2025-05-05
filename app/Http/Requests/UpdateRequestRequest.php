<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestRequest extends FormRequest
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
            'account_id' => 'required|exists:accounts,id',
            'embassy_id' => 'required|exists:embassies,id',
            'member_id' => 'required|exists:members,id',
            'country_id' => 'required|exists:countries,id',
            'type' => 'required|in:Diaspora,Domestic',
            'request_items' => 'required|array|min:1',
            'request_items.*.service_provider_id' => 'required|exists:service_providers,id',
            'request_items.*.service_id' => 'required|exists:services,id',
            'request_items.*.price' => 'required|numeric|min:0',
            'request_items.*.certificate_holder_name' => 'required|string|max:255',
            'request_items.*.certificate_index_number' => 'nullable|string|max:255',
            'request_items.*.attachment' => 'nullable|file',
        ];
    }
}
