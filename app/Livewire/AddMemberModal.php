<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member;

class AddMemberModal extends Component
{
    public $name;
    public $email;
    public $phone;

    public function saveMember()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255 |unique:members,email',
            'phone' => 'nullable|string|max:255|unique:members,phone',
        ]);

        $member = Member::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->reset(); // Clear the form fields
        $this->dispatch('member-added');
        $this->dispatch('refreshMembers'); 
        $this->dispatch('memberAdded', $member->id, $member->name);
    }

    public function render()
    {
        return view('livewire.add-member-modal');
    }
}
