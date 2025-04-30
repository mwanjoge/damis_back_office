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
            $embassy = $event->record;
            
            // Push the embassy data to the public server
            $response = Http::public()->post('/api/embassy', [
                'id' => $embassy->id,
                'name' => $embassy->name,
                'type' => $embassy->type,
                'is_active' => $embassy->is_active,
            ]);
        }

        if($record instanceof \App\Models\Country){
            
            // Push the country data to the public server
            Http::public()->post('api/country', [
                'name' => $record->name,
                'code' => $record->code,
                'phone_code' => $record->phone_code,
            ]);
        }
    }
}
