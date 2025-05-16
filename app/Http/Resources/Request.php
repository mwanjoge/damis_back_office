<?php

namespace App\Http\Resources;

use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class Request extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(HttpRequest $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'status' => $this->status,
            'tracking_number' => $this->tracking_number,
            'code' => $this->code,
            'member_details' => new Member($this->member),
            'invoice_details' => new Invoice($this->invoice)
        ];
    }
}
