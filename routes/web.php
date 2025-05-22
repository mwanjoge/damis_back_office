<?php

use App\Http\Controllers\AuditController;
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
use App\Http\Controllers\Auth\PasswordController;


Auth::routes();


Route::middleware(['auth'])->group(function () {
    // Password change routes - accessible even with default password
    Route::get('/password/change', [PasswordController::class, 'showChangeForm'])->name('password.change');
    Route::post('/password/update', [PasswordController::class, 'update'])->name('password.update');

    // All other routes - require password to be changed
    Route::middleware([\App\Http\Middleware\CheckDefaultPassword::class])->group(function () {
    //Route::post('embassy/update/{id}', [EmbassyController::class,'update'])->name('embassy.update');
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
   // EMBASSY ROUTES
Route::get('embassy', [EmbassyController::class, 'index'])->name('embassy.index');
Route::get('embassy/create', [EmbassyController::class, 'create'])->name('embassy.create');
Route::post('embassy', [EmbassyController::class, 'store'])->name('embassy.store');
Route::get('embassy/{embassy}', [EmbassyController::class, 'show'])->name('embassy.show');
Route::get('embassy/{embassy}/edit', [EmbassyController::class, 'edit'])->name('embassy.edit');
Route::put('embassy/{embassy}', [EmbassyController::class, 'update'])->name('embassy.update');
Route::delete('embassy/{embassy}', [EmbassyController::class, 'destroy'])->name('embassy.destroy');

// COUNTRY ROUTES
Route::get('country', [CountryController::class, 'index'])->name('country.index');
Route::get('country/create', [CountryController::class, 'create'])->name('country.create');
Route::post('country', [CountryController::class, 'store'])->name('country.store');
Route::get('country/{country}', [CountryController::class, 'show'])->name('country.show');
Route::get('country/{country}/edit', [CountryController::class, 'edit'])->name('country.edit');
Route::put('country/{country}', [CountryController::class, 'update'])->name('country.update');
Route::delete('country/{country}', [CountryController::class, 'destroy'])->name('country.destroy');

// SERVICE PROVIDER ROUTES
Route::get('service_provider', [ServiceProviderController::class, 'index'])->name('service_provider.index');
Route::get('service_provider/create', [ServiceProviderController::class, 'create'])->name('service_provider.create');
Route::post('service_provider', [ServiceProviderController::class, 'store'])->name('service_provider.store');
Route::get('service_provider/{service_provider}', [ServiceProviderController::class, 'show'])->name('service_provider.show');
Route::get('service_provider/{service_provider}/edit', [ServiceProviderController::class, 'edit'])->name('service_provider.edit');
Route::put('service_provider/{service_provider}', [ServiceProviderController::class, 'update'])->name('service_provider.update');
Route::delete('service_provider/{service_provider}', [ServiceProviderController::class, 'destroy'])->name('service_provider.destroy');

// SERVICE ROUTES
Route::get('service', [\App\Http\Controllers\ServiceController::class, 'index'])->name('service.index');
Route::get('service/create', [\App\Http\Controllers\ServiceController::class, 'create'])->name('service.create');
Route::post('service', [\App\Http\Controllers\ServiceController::class, 'store'])->name('service.store');
Route::get('service/{service}', [\App\Http\Controllers\ServiceController::class, 'show'])->name('service.show');
Route::get('service/{service}/edit', [\App\Http\Controllers\ServiceController::class, 'edit'])->name('service.edit');
Route::put('service/{service}', [\App\Http\Controllers\ServiceController::class, 'update'])->name('service.update');
Route::delete('service/{service}', [\App\Http\Controllers\ServiceController::class, 'destroy'])->name('service.destroy');

// REQUESTS ROUTES
Route::get('requests', [RequestController::class, 'index'])->name('requests.index');
Route::get('requests/create', [RequestController::class, 'create'])->name('requests.create');
Route::post('requests', [RequestController::class, 'store'])->name('requests.store');
Route::get('requests/{request}', [RequestController::class, 'show'])->name('requests.show');
Route::get('requests/{request}/edit', [RequestController::class, 'edit'])->name('requests.edit');
Route::put('requests/{request}', [RequestController::class, 'update'])->name('requests.update');
Route::delete('requests/{request}', [RequestController::class, 'destroy'])->name('requests.destroy');

// MEMBERS ROUTES
Route::get('members', [\App\Http\Controllers\MemberController::class, 'index'])->name('members.index');
Route::get('members/create', [\App\Http\Controllers\MemberController::class, 'create'])->name('members.create');
Route::post('members', [\App\Http\Controllers\MemberController::class, 'store'])->name('members.store');
Route::get('members/{member}', [\App\Http\Controllers\MemberController::class, 'show'])->name('members.show');
Route::get('members/{member}/edit', [\App\Http\Controllers\MemberController::class, 'edit'])->name('members.edit');
Route::put('members/{member}', [\App\Http\Controllers\MemberController::class, 'update'])->name('members.update');
Route::delete('members/{member}', [\App\Http\Controllers\MemberController::class, 'destroy'])->name('members.destroy');

// DEPARTMENT ROUTES
Route::get('department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
Route::get('department/create', [App\Http\Controllers\DepartmentController::class, 'create'])->name('department.create');
Route::post('department', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.store');
Route::get('department/{department}', [App\Http\Controllers\DepartmentController::class, 'show'])->name('department.show');
Route::get('department/{department}/edit', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('department.edit');
Route::put('department/{department}', [App\Http\Controllers\DepartmentController::class, 'update'])->name('department.update');
Route::delete('department/{department}', [App\Http\Controllers\DepartmentController::class, 'destroy'])->name('department.destroy');

// DESIGNATION ROUTES
Route::get('designation', [App\Http\Controllers\DesignationController::class, 'index'])->name('designation.index');
Route::get('designation/create', [App\Http\Controllers\DesignationController::class, 'create'])->name('designation.create');
Route::post('designation', [App\Http\Controllers\DesignationController::class, 'store'])->name('designation.store');
Route::get('designation/{designation}', [App\Http\Controllers\DesignationController::class, 'show'])->name('designation.show');
Route::get('designation/{designation}/edit', [App\Http\Controllers\DesignationController::class, 'edit'])->name('designation.edit');
Route::put('designation/{designation}', [App\Http\Controllers\DesignationController::class, 'update'])->name('designation.update');
Route::delete('designation/{designation}', [App\Http\Controllers\DesignationController::class, 'destroy'])->name('designation.destroy');

// EMPLOYEE ROUTES
Route::get('employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');
Route::get('employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
Route::post('employee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
Route::get('employee/{employee}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.show');
Route::get('employee/{employee}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('employee/{employee}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update');
Route::delete('employee/{employee}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.destroy');

// AUDIT ROUTES
Route::get('audits', [AuditController::class, 'index'])->name('audits.index');
Route::get('audits/create', [AuditController::class, 'create'])->name('audits.create');
Route::post('audits', [AuditController::class, 'store'])->name('audits.store');
Route::get('audits/{audit}', [AuditController::class, 'show'])->name('audits.show');
Route::get('audits/{audit}/edit', [AuditController::class, 'edit'])->name('audits.edit');
Route::put('audits/{audit}', [AuditController::class, 'update'])->name('audits.update');
Route::delete('audits/{audit}', [AuditController::class, 'destroy'])->name('audits.destroy');
 Route::post('employee/{employee}/reset-password', [App\Http\Controllers\EmployeeController::class, 'resetPassword'])->name('employee.reset-password');
    Route::get('settings', function () {
        return view('settings');
    })->name('settings');
    Route::get('human_resources', function () {
        return view('human_resources');
    })->name('human_resources');
    Route::get('apps-chat', function () {
        return view('apps-chat');
    })->name('apps-chat');

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

    Route::post('/request/approve/{id}', [RequestController::class, 'approveRequest'])->name('requests.approve');
    Route::post('/request/reject', [RequestController::class, 'rejectRequest'])->name('requests.reject');
    // Route::get('/tables', function () {
    //     return view('tables');
    // })->name('tables');
    // Route::get('/embassies/{id}', [EmbassyController::class, 'show'])->name('embassies.show');
    // Route::post('/embassies/{id}/accredit-country', [EmbassyController::class, 'accreditCountry'])->name('embassies.accreditCountry');
    // Route::delete('/embassies/{embassy}/country/{country}', [EmbassyController::class, 'removeCountry'])->name('embassies.removeCountry');
    });
});
