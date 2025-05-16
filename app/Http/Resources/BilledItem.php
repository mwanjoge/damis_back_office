<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BilledItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'service_id' => $this->service_id,
            'service_name' => $this->service->name,
            'service_provider_id' => $this->service_provider_id,
            'service_provider_name' => $this->serviceProvider->name,
            'price' => $this->price
        ];
    }
}
