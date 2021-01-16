<?php

namespace App\Listeners;

use App\Events\UpdateAdminOnOrderComplete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderUpdateNotificationToAdmin
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
     * @param  UpdateAdminOnOrderComplete  $event
     * @return void
     */
    public function handle(UpdateAdminOnOrderComplete $event)
    {
        //
    }
}