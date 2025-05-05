<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'account_id'     => 'required|exists:accounts,id',
            'request_id'     => 'required|exists:requests,id',
            'member_id'      => 'required|exists:members,id',
            'invoice_date'   => 'required|date',
            'due_date'       => 'required|date|after_or_equal:invoice_date',
            'customer_name'  => 'nullable|string|max:255',
            'ref_no'         => 'nullable|string|max:255',
            'status'         => 'required|in:pending,paid,cancelled,overdue',
            'sent_status'    => 'required|in:sent,failed',
        ];
    }
}
