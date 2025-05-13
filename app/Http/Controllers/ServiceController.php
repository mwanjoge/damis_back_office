<?php

namespace App\Http\Controllers;

use App\Events\EmbassyCreated;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Exception;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:read_service')->only(['index', 'show']);
        $this->middleware('permission:create_service')->only(['create', 'store']);
        $this->middleware('permission:update_service')->only(['edit', 'update']);
        $this->middleware('permission:delete_service')->only(['destroy']);
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
            $service = Service::query()->create($request->validated());
            event(new EmbassyCreated($service));
            session()->flash('success', 'Service created successfully!');
            return redirect()->route('settings');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create service: ' . $e->getMessage()]);
        }
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
    public function update(UpdateServiceRequest $request, $serviceId)
    {
        try {
            $service = Service::find($serviceId);
            $service->update($request->validated());
            return redirect()->route('settings')->with('success', 'Service updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update service: ' . $e->getMessage()]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $serviceId )
    {

        try {
            $service = Service::find($serviceId);
            $service->delete();
            return redirect()->back()->with('success', 'Service deleted successfully!');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete service: ' . $e->getMessage());
        }
    }
}