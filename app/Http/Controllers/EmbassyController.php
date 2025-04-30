<?php

namespace App\Http\Controllers;

use App\Events\EmbassyCreated;
use App\Http\Requests\StoreEmbassyRequest;
use App\Http\Requests\UpdateEmbassyRequest;
use App\Models\Embassy;
use App\Services\EmbassyService;
use Illuminate\Support\Facades\DB;

class EmbassyController extends Controller
{

    public function __construct(protected EmbassyService $embassyService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmbassyRequest $request)
    {
        
        DB::transaction(function () use ($request) {
            $embassy = $this->embassyService->create($request);
            $account = $this->embassyService->createAccount($request);
            $embassy->account()->save($account);

            $this->embassyService->attachCountries($embassy, $request);

            // Dispatch the event to push the embassy data to the public server
            event(new EmbassyCreated($embassy));
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Embassy $embassy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Embassy $embassy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmbassyRequest $request, Embassy $embassy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Embassy $embassy)
    {
        //
    }
}
