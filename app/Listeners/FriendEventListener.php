<?php

namespace App\Listeners;

use App\Events\AcceptFriendEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FriendEventListener
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
     * @param  AcceptFriendEvent  $event
     * @return void
     */
    public function handle(AcceptFriendEvent $event)
    {
        //
    }
}
