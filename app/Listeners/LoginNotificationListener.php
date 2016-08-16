<?php

namespace App\Listeners;

use App\Events\LoginNotificationEvent;
use App\Providers\Constants\CommonConstants;
use Davibennun\LaravelPushNotification\Facades\PushNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginNotificationListener
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
     * @param  LoginNotificationEvent $event
     * @return void
     */
    public function handle(LoginNotificationEvent $event)
    {

        $device_token = $event->device_token;
        $notification_status = $event->notification_status;
//        dd($device_token);
       /* if ($notification_status == CommonConstants::STATUS_ONLINE) {
            PushNotification::app('appNameAndroid')
                ->to($device_token)
                ->send('login');
        } elseif ($notification_status == CommonConstants::STATUS_OFFLINE) {
            //
            return response()->json(['msg' => 'no any notification']);
        }*/

    }
}
