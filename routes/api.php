<?php

use App\Http\Controllers\API\AcknowledgeController;
use App\Http\Controllers\API\MemberController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EmbassyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceProviderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('embassy', EmbassyController::class)->names('embassy');
Route::resource('country', CountryController::class)->names('country');
Route::resource('service_provider', ServiceProviderController::class)->names('service_provider');
Route::post('acknowledge', [AcknowledgeController::class, 'acknowledge']);

Route::post('testJamii', function () {
    return response()->json([
        'status' => 'success',
        'code' => 200,
        'message' => 'Hello from Jamii API',
    ]);
});
Route::prefix('v1')->group(function () {
    Route::post('members', [MemberController::class, 'store'])->name('v1.members.store');
    Route::post('requests', [\App\Http\Controllers\API\RequestController::class, 'store']);
});
