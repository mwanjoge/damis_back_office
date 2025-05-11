<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Designation;
use App\Models\Account;

class DesignationTable extends Component
{
    public $designations = [];
    public $accounts = [];

    public function mount()
    {
        $this->designations = Designation::with('account')->get();
        $this->accounts = Account::all();
    }

    public function render()
    {
        return view('livewire.designation-table', [
            'designations' => $this->designations,
            'accounts' => $this->accounts,
        ]);
    }
}
