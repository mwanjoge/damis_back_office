<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
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
    public function store(StoreDesignationRequest $request)
    {
        try {
            $data = $request->validated();
            Designation::create($data);
            return redirect()->route('humanresors')->with('success', 'Designation created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('humanresors')->with('error', 'Failed to create designation: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        try {
            $data = $request->validated();
            $designation->update($data);
            return redirect()->route('humanresors')->with('success', 'Designation updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('humanresors')->with('error', 'Failed to update designation: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        try {
            $designation->delete();
            return redirect()->route('humanresors')->with('success', 'Designation deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('humanresors')->with('error', 'Failed to delete designation: ' . $e->getMessage());
        }
    }
}
