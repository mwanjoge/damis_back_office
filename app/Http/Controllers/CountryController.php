<?php

namespace App\Http\Controllers;

use App\Events\EmbassyCreated;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function __construct()
    // {
    //     $model = 'country';
    //     $this->middleware("permission:view {$model}")->only(['index', 'show']);
    //     $this->middleware("permission:create {$model}")->only(['create', 'store']);
    //     $this->middleware("permission:edit {$model}")->only(['edit', 'update']);
    //     $this->middleware("permission:delete {$model}")->only(['destroy']);
    // }

    public function index()
    {
        return view('countries.index');
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
    public function store(StoreCountryRequest $request)
    {
        $request->validated();
        try {
            $country = Country::query()->create($request->all());
            event(new EmbassyCreated($country));
            session()->flash('success', 'Country created successfully!');
            return redirect()->route('settings');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create country: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->all());
        return redirect()->route('settings')->with('success', 'Country updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        try {
            $country->delete();
            return redirect()->json()->with('success', 'Country deleted successfully');
        } catch (\Exception $e) {
            return redirect()->json()->with('error', 'Failed to delete country: ' . $e->getMessage());
        }
    }
}
