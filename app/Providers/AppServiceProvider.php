<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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

         View::composer('*', function ($view) {
        $routeName = Route::currentRouteName(); // Get the current route name

        // Default breadcrumbs
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Requests', 'url' => route('requests.index')],
        ];

        // Add specific breadcrumbs for create and edit views
        if ($routeName === 'requests.create') {
            $breadcrumbs[] = ['name' => 'Create Request', 'url' => route('requests.create')];
        } elseif ($routeName === 'requests.edit') {
            $breadcrumbs[] = ['name' => 'Edit Request', 'url' => url()->current()];
        }

        $view->with('breadcrumbs', $breadcrumbs);
    });
    }

}
