<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmbassyRequest extends FormRequest
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
            'name'        => 'required|string|max:255|unique:embassies,name,' . $this->route('embassy'),
            'type'        => 'required|in:Embassy,Permanent Mission,High Commission',
            'location_id' => 'required|exists:countries,id',
            'is_active'   => 'boolean',
            'country_id'  => 'array',
            'country_id.*' => 'exists:countries,id',
        ];
    }
}
