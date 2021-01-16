<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;

class Writer extends Component
{
        public $order;
        
    public function render()
    {
        return view('livewire.orders.writer');
    }
}