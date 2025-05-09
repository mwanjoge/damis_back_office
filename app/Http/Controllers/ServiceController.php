<?php

namespace App\Http\Controllers;

use App\Events\EmbassyCreated;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Exception;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $model = 'service';
        $this->middleware("permission:view {$model}")->only(['index', 'show']);
        $this->middleware("permission:create {$model}")->only(['create', 'store']);
        $this->middleware("permission:edit {$model}")->only(['edit', 'update']);
        $this->middleware("permission:delete {$model}")->only(['destroy']);
    }

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
    public function store(StoreServiceRequest $request)
    {
        try {
            $service = Service::query()->create($request->all());
            event(new EmbassyCreated($service));
            session()->flash('success', 'Service created successfully!');
        } catch (Exception $e) {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create request: ' . $e->getMessage()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        if ($service) {
            $service->update($request->all());
            session()->flash('success', 'Service updated successfully!');
        } else {
            session()->flash('error', 'Service not found!');
        }
        return redirect()->route('settings');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
