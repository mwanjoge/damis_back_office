<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $data = $request->validated();
            // Get account_id from the selected designation
            $designation = \App\Models\Designation::find($data['designation_id']);
            if (!$designation) {
                return redirect()->route('human_resors')->with('error', 'Invalid designation selected.');
            }
            $data['account_id'] = $designation->account_id;
            Employee::create($data);
            return redirect()->route('human_resors')->with('success', 'Employee created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resors')->with('error', 'Failed to create employee: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            $data = $request->validated();
            $designation = \App\Models\Designation::find($data['designation_id']);
            if (!$designation) {
                return redirect()->route('human_resors')->with('error', 'Invalid designation selected.');
            }
            $data['account_id'] = $designation->account_id;
            $employee->update($data);
            return redirect()->route('human_resors')->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resors')->with('error', 'Failed to update employee: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return redirect()->route('human_resors')->with('success', 'Employee deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resors')->with('error', 'Failed to delete employee: ' . $e->getMessage());
        }
    }
}
