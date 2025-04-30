<?php

use App\Http\Controllers\EmbassyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return csrf_token();
});


