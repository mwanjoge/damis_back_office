<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Request;

class RequestShow extends Component
{
    public $request;

    public function mount($id)
    {
        $this->request = Request::findOrFail($id);
    }

    public function approve()
    {
        $this->request->is_approved = true;
        $this->request->save();
        session()->flash('success', 'Request approved!');
        $this->request->refresh();
    }

    public function render()
    {
        return view('livewire.request-show');
    }
}
