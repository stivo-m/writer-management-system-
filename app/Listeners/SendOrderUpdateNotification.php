<?php

namespace App\Listeners;

use App\Events\OrderUpdate;
use App\Notifications\OrderStateChange;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class SendOrderUpdateNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderUpdate  $event
     * @return void
     */
    public function handle(OrderUpdate $event)
    {
        //
        $user = User::find($event->order->writer_id);

        $user->notify(new OrderStateChange($event->order, $user));
        
    }
}