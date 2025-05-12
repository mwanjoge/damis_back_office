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

    public function __construct()
    {
        $model = 'designation';
        $this->middleware("permission:read_{$model}")->only(['index', 'show']);
        $this->middleware("permission:create_{$model}")->only(['create', 'store']);
        $this->middleware("permission:update_{$model}")->only(['edit', 'update']);
        $this->middleware("permission:delete_{$model}")->only(['destroy']);
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
    public function store(StoreDesignationRequest $request)
    {
        try {
            $data = $request->validated();
            Designation::create($data);
            return redirect()->route('human_resources')->with('success', 'Designation created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resources')->with('error', 'Failed to create designation: ' . $e->getMessage());
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
            return redirect()->route('human_resources')->with('success', 'Designation updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resources')->with('error', 'Failed to update designation: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        try {
            $designation->delete();
            return response()->json(['message' => 'Designation deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting designation'], 500);
        }
    }
}
