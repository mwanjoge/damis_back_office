<?php

namespace App\Livewire;

use App\Models\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class RequestSummaryBar extends Component
{
    public $summary = [
        'Pending' => 0,
        'In Progress' => 0,
        'Completed' => 0,
        'Cancelled' => 0,
    ];

    public $totalCost = [
        'Pending' => 0,
        'In Progress' => 0,
        'Completed' => 0,
        'Cancelled' => 0,
    ];

    public function mount($summary = [])
    {
        $requests = \App\Models\Request::all();
        
        $totalCost= [
            'Pending' => $requests->where('status', 'Pending')->sum('total_cost'),
            'In Progress' => $requests->where('status', 'In Progress')->sum('total_cost'),
            'Completed' => $requests->where('status', 'Completed')->sum('total_cost'),
            'Cancelled' => $requests->where('status', 'Cancelled')->sum('total_cost'),
        ];
        
        $this->totalCost = array_merge($this->totalCost, $totalCost);
        $this->summary = array_merge($this->summary, $summary);
    }

    public function render()
    {
        return view('livewire.request-summary-bar');
    }
}
