<?php

namespace App\Listeners;

use App\Events\LogoutNotificationEvent;

use Davibennun\LaravelPushNotification\Facades\PushNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogoutNotificationListener
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
     * @param  LogoutNotificationEvent  $event
     * @return void
     */
    public function handle(LogoutNotificationEvent $event)
    {
        $device_token=$event->device_token;
        PushNotification::app('androidName')
            ->to($device_token)
            ->send('logout successfully');

    }
}
