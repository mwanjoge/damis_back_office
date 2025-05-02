<?php

namespace App\Livewire;

use Livewire\Component;

class RequestSummaryBar extends Component
{
    public $summary = [
        'Pending' => 0,
        'In Progress' => 0,
        'Completed' => 0,
        'Cancelled' => 0,
    ];

    public function mount($summary = [])
    {
        $this->summary = array_merge($this->summary, $summary);
    }

    public function render()
    {
        return view('livewire.request-summary-bar');
    }
}
