<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $order;

    public function render()
    {
        return view('livewire.orders.index');
    }


}