<?php

namespace App\Http\Controllers;

use App\Events\EmbassyCreated;
use App\Http\Requests\StoreServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('service_providers.index');
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
    public function store(StoreServiceProviderRequest $request)
    {
        dd($request);
        try {
            DB::transaction(function () use ($request) {
                $serviceProvider = ServiceProvider::query()
                ->create([
                    'name' => $request->name,
                ]);

                if($request->service_name[0] != null){
                    foreach ($request->service_name as $service) {
                        $serviceProvider->services()
                            ->create(
                                [
                                    'name' => $service,
                                    'service_provider_id' => $serviceProvider->id,
                                ]);
                    }
                }

                // Dispatch the event to push the service provider data to the public server
                event(new EmbassyCreated($serviceProvider));
                session()->flash('success', 'Service Provider saved successfully!');
                
            });
            return redirect()->route('settings');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) { // Integrity constraint violation
                return redirect()->back()->with('error', 'Service name already exists!');
            }
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceProviderRequest $request, ServiceProvider $serviceProvider)
    {
        $serviceProvider->update($request->all());
        return redirect()->route('settings')->with('success', 'Service Provider updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        //
    }
}
