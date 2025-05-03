<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillableItemRequest;
use App\Http\Requests\UpdateBillableItemRequest;
use App\Models\BillableItem;
use App\Models\Country;
use App\Models\Service;

class BillableItemController extends Controller
{
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
    public function store(StoreBillableItemRequest $request)
    {
        Service::query()->get()->each(function ($service) use ($request) {
            $service->billableItems()->create([
                'account_id' => $request->account_id,
                'embassy_id' => $request->embassy_id,
                'country_id' => $request->country_id,
                'price' => $request->price,
                'currency' => $request->currency,
            ]);
        });

        session()->flash('success', 'Billable Item created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(BillableItem $billableItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillableItem $billableItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillableItemRequest $request, BillableItem $billableItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillableItem $billableItem)
    {
        //
    }
}
