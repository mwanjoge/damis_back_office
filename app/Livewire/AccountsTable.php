<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Embassy;

class AccountsTable extends Component
{
    public function render()
    {
        return view('livewire.accounts-table', [
            'embassies' => Embassy::with('account')->get()
        ]);
    }
}
