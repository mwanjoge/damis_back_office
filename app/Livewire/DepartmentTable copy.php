<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Department;

class DepartmentTable extends Component
{
    public $departments = [];

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function render()
    {
        return view('livewire.department-table', [
            'departments' => $this->departments,
        ]);
    }
}
