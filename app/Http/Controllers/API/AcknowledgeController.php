<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AcknowledgeController extends Controller
{
    public function __construct(){}

    public function acknowledge(Request $request)
    {
        Log::info('acknoledge');
        Log::info('Acknowledgment received', [
            'data' => $request->all(),
        ]);
    }
}
