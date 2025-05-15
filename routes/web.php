<?php

use App\Http\Controllers\CountryController;
use App\Livewire\RequestItems;
use App\Livewire\SettingsPage;
use App\Models\RequestItem;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmbassyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RoleController;

Auth::routes();


Route::middleware(['auth'])->group(function () {
    //Route::post('embassy/update/{id}', [EmbassyController::class,'update'])->name('embassy.update');
    Route::resource('embassy', EmbassyController::class)->names('embassy');
    //Language Translation
    Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
    //Language Translation
    Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    //Update User Details
    Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

    Route::get('/profile', function () {
        return view('pages-profile');
    })->name('user-profile');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Route::resource('embassy', EmbassyController::class)->names('embassy');
    Route::resource('country', CountryController::class)->names('country');
    Route::post('bills', [App\Http\Controllers\BillableItemController::class, 'store'])->name('bills.store');
    Route::resource('service_provider', ServiceProviderController::class)->names('service_provider');
    Route::resource('service', \App\Http\Controllers\ServiceController::class)->names('service');
    Route::resource('requests', RequestController::class)->names('requests');
    Route::resource('members', \App\Http\Controllers\MemberController::class)->names('members');
    Route::resource('department', App\Http\Controllers\DepartmentController::class)->names('department');
    Route::resource('designation', App\Http\Controllers\DesignationController::class)->names('designation');
    Route::resource('employee', App\Http\Controllers\EmployeeController::class)->names('employee');
    Route::get('settings', function () {
        return view('settings');
    })->name('settings');
    Route::get('human_resources', function () {
        return view('human_resources');
    })->name('human_resources');

    Route::get('/embassies/{id}', [HomeController::class, 'showEmbassy'])->name('embassies.show');
    Route::get('/requestItem', RequestItems::class);
    // routes/web.php
    // Remove duplicate /roles route

    Route::get('/roles', [RoleController::class, 'rolesIndex'])->name('roles.index');
    Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/authentication', [RoleController::class, 'authenticationIndex'])->name('authentication');
    Route::post('/roles', [RoleController::class, 'createRole'])->name('roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'updateRole'])->name('roles.update');
    Route::put('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.update-permissions');
    Route::post('/users/assign-role', [RoleController::class, 'assignRole'])->name('users.assignRole');
    Route::get('/billable-price', [RequestController::class, 'getPrice']);


    // Route::get('/tables', function () {
//     return view('tables');
// })->name('tables');
    // Route::get('/embassies/{id}', [EmbassyController::class, 'show'])->name('embassies.show');
    // Route::post('/embassies/{id}/accredit-country', [EmbassyController::class, 'accreditCountry'])->name('embassies.accreditCountry');
    // Route::delete('/embassies/{embassy}/country/{country}', [EmbassyController::class, 'removeCountry'])->name('embassies.removeCountry');
});
