<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            'App\Events\EmbassyCreated',
            'App\Listeners\PushCreatedRecordsToPublicServer'
        );
        
        Http::macro('public', function () {
            return Http::withHeaders([
                'Connection' => 'keep-alive'
            ])->baseUrl(config('api.public_api_base_url'));
        });
    }
}
