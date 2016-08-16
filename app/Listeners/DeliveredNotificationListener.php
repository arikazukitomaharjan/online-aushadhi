<?php

    namespace App\Listeners;

    use App\Events\DeliveredNotificationEvent;
    use Davibennun\LaravelPushNotification\Facades\PushNotification;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;

    class DeliveredNotificationListener
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
         * @param  DeliveredNotificationEvent $event
         *
         * @return void
         */
        public function handle(DeliveredNotificationEvent $event)
        {

            $device_token = $event->device_token;

            PushNotification::app('appNameAndroid')
                ->to($device_token)
                ->send('Medicine is delivered. please confirm it');
        }
    }
