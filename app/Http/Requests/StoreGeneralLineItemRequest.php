<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralLineItemRequest extends FormRequest
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
            'account_id'          => 'required|exists:accounts,id',
            'lineable_id'         => 'required|integer',
            'lineable_type'       => 'required|string|max:255',
            'service_id'          => 'nullable|exists:services,id',
            'service_provider_id' => 'nullable|exists:service_providers,id',
            'request_item_id'     => 'nullable|exists:request_items,id',
            'price'               => 'required|numeric|min:0',
            'currency'            => 'required|string|max:10',
        ];
    }
}
