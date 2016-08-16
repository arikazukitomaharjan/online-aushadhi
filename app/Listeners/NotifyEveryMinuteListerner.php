<?php

namespace App\Listeners;

use App\Events\NotifyEveryMinuteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyEveryMinuteListerner
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
     * @param  NotifyEveryMinuteEvent  $event
     * @return void
     */
    public function handle(NotifyEveryMinuteEvent $event)
    {
        //
    }
}
