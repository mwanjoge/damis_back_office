<?php

use App\Http\Controllers\CountryController;
use App\Livewire\SettingsPage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmbassyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceProviderController;

//Language Translation
Route::get('token_check', function () {
    return csrf_token();
});

Route::resource('embassy', EmbassyController::class)->names('embassy');

Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/settings', SettingsPage::class)->name('settings');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::resource('embassy', EmbassyController::class)->names('embassy');
Route::resource('country', CountryController::class)->names('country');
Route::resource('service_provider', ServiceProviderController::class)->names('service_provider');

