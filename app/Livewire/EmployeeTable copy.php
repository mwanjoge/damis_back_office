<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;

class EmployeeTable extends Component
{
    public $employees = [];
    public $departments = [];
    public $designations = [];

    public function mount()
    {
        $this->employees = Employee::with(['department', 'designation'])->get();
        $this->departments = Department::all();
        $this->designations = Designation::all();
    }

    public function render()
    {
        return view('livewire.employee-table', [
            'employees' => $this->employees,
            'departments' => $this->departments,
            'designations' => $this->designations,
        ]);
    }
}
