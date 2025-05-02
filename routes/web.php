<?php

use App\Http\Controllers\CountryController;
use App\Livewire\SettingsPage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmbassyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\RequestController;

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::resource('embassy', EmbassyController::class)->names('embassy');
    //Language Translation
    Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

    //Update User Details
    Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');
    Route::get('/profile/{id}', function () {
        return view('pages-profile');
    })->name('pages-profile');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('embassy', EmbassyController::class)->names('embassy');
    Route::resource('country', CountryController::class)->names('country');
    Route::resource('service_provider', ServiceProviderController::class)->names('service_provider');
    Route::resource('service', \App\Http\Controllers\ServiceController::class)->names('service');
    Route::resource('requests', RequestController::class)->names('requests');
    Route::resource('members', \App\Http\Controllers\MemberController::class)->names('members');
    Route::get('settings', function () {
        return view('settings');
    })->name('settings');
});


