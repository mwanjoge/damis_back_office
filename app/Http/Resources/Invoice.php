<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Invoice extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'invoice_date' => $this->invoice_date,
            'due_date' => $this->due_date,
            'ref_no' => $this->ref_no,
            'currency' => $this->currency,
            'amount' => $this->payable_amount,
            'controll_number' => $this->controll_number ?? null,
            'billed_items' => new BilledItem($this->generalLineItems),
        ];
    }
}
