<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $model = 'department';
        $this->middleware("permission:read_{$model}")->only(['index', 'show']);
        $this->middleware("permission:create_{$model}")->only(['create', 'store']);
        $this->middleware("permission:update_{$model}")->only(['edit', 'update']);
        $this->middleware("permission:delete_{$model}")->only(['destroy']);
    }

    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
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
    public function store(StoreDepartmentRequest $request)
    {
        try {
            Department::create($request->validated());
            return redirect()->route('human_resources')->with('success', 'Department created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resources')->with('error', 'Failed to create department: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, int  $id)
    {
        $department = Department::query()->find($id);
        try {
            $data = $request->validated();
            $department->update($data);
            return redirect()->route('human_resources')->with('success', 'Department updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resources')->with('error', 'Failed to update department: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return redirect()->route('human_resources')->with('success', 'Department deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resources')->with('error', 'Failed to delete department: ' . $e->getMessage());
        }
    }
}
