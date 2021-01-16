<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;


class Users extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.users', [
            'users' => User::latest()->paginate(10)
        ]);
    }
}