<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Mail\PasswordSetupMail;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('permission:read_employee')->only(['index', 'show']);
        $this->middleware('permission:create_employee')->only(['create', 'store']);
        $this->middleware('permission:update_employee')->only(['edit', 'update', 'resetPassword']);
        $this->middleware('permission:delete_employee')->only(['destroy']);
    }

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

        $designation = \App\Models\Designation::find($data['designation_id']);
        if (!$designation) {
            return redirect()->route('human_resources')->with('error', 'Invalid designation selected.');
        }

        $data['account_id'] = $designation->account_id;

        $employee = Employee::create($data);

        $user = User::create([
            'name' => $employee->first_name . ' ' . $employee->last_name,
            'email' => $employee->email,
            'password' => Hash::make('User@12345'),
            'userable_id' => $employee->id,
            'userable_type' => Employee::class,
            'is_default_password' => true,
        ]);

        return redirect()->route('human_resources')->with('success', 'Employee created successfully.');
    } catch (\Exception $e) {
        return redirect()->route('human_resources')->with('error', 'Failed to create employee: ' . $e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $employee = Employee::query()->find($id);
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
    public function update(UpdateEmployeeRequest $request, int $id)
    {
        $employee = Employee::query()->find($id);
        try {
            $data = $request->validated();
            $employee->update($data);
            return redirect()->route('human_resources')->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resources')->with('error', 'Failed to update employee: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            User::where('userable_id', $employee->id)->where('userable_type', Employee::class)->delete();

            $employee->delete();

            return redirect()->route('human_resources')->with('success', 'Employee deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resources')->with('error', 'Failed to delete employee: ' . $e->getMessage());
        }
    }

    /**
     * Reset the user's password to the default value.
     */
    public function resetPassword(Employee $employee)
    {
        try {
            $user = User::where('userable_id', $employee->id)
                        ->where('userable_type', Employee::class)
                        ->first();

            if (!$user) {
                return redirect()->route('human_resources')->with('error', 'User account not found for this employee.');
            }

            $user->password = Hash::make('User@12345');
            $user->is_default_password = true;
            $user->save();

            return redirect()->route('human_resources')->with('success', 'Password has been reset to default successfully.');
        } catch (\Exception $e) {
            return redirect()->route('human_resources')->with('error', 'Failed to reset password: ' . $e->getMessage());
        }
    }
}
