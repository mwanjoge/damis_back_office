<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PushCreatedRecordsToPublicServer
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $record = $event->record;
        // Check if the event is of the type we want to handle
        if ($event->record instanceof \App\Models\Embassy) {
            
            // Push the embassy data to the public server
            $response = Http::public()->post('/api/embassy', [
                'id' => $record->id,
                'name' => $record->name,
                'type' => $record->type,
                'is_active' => $record->is_active,
            ]);
        }

        if($record instanceof \App\Models\Country){

            // Push the country data to the public server
            Http::public()->post('api/country', [
                'name' => $record->name,
                'code' => $record->code,
                'phone_code' => $record->phone_code,
                'id' => $record->id,
            ]);
        }

        if($record instanceof \App\Models\ServiceProvider){

            // Push the service provider data to the public server
            Http::public()->post('api/service_provider', [
                'name' => $record->name,
                'account_id' => $record->email,
                'id' => $record->id,
                'services' => $record->services->map(function ($service) {
                    return [
                        'name' => $service->name,
                        'account_id' => $service->account_id,
                        'id' => $service->id,
                        'service_provider_id' => $service->service_provider_id,
                    ];
                }),
            ]);
        }
    }
}
