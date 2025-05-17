<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Request;

class RequestTable extends Component
{
    public $status = 'Pending';
    public $requests = [];

    public function mount()
    {
        $this->requests = Request::where('status','Pending')->get();
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getFilteredRequestsProperty()
    {
        $this->requests = Request::where('status', $this->status)->get();
    }

    public function render()
    {
        return view('livewire.request-table')->extends('layouts.tabler.app');
    }
}