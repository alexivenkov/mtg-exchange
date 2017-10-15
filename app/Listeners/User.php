<?php

namespace App\Listeners;

use App\Events\UserAddCard;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class User
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
     * @param  UserAddCard  $event
     * @return void
     */
    public function handle(UserAddCard $event)
    {
        //
    }
}
