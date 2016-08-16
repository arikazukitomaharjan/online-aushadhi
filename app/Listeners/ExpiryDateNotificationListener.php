<?php

    namespace App\Listeners;

    use App\Events\ExpiryDateNotificationEvent;
    use App\Models\Notification\Notification;
    use App\Providers\Constants\CommonConstants;
    use Davibennun\LaravelPushNotification\Facades\PushNotification;

    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Support\Facades\Auth;

    class ExpiryDateNotificationListener
    {

        /**
         * Create the event listener.
         *
         * @return void
         */
        public function __construct()
        {

            //
            //            $this->middleware('headers.verify');
        }





        /**
         * Handle the event.
         *
         * @param  ExpiryDateNotificationEvent $event
         *
         * @return void
         */
        public function handle(ExpiryDateNotificationEvent $event)
        {
            $user_id=22;

            $device_token = $event->device_token;
            $notification_status = $event->device_notification;
            $user_id_event = $event->user_id;

            //            $devices=$device_token->toArray();
            //            print_r($device_token);
            //            $notification =new Notification();
            //            $sendNotification=$notification->sendNotification($device_token);
            //;s
            /*$devices = PushNotification::DeviceCollection([
                PushNotification::Device($device_token , ['msg' => 'please refill your medicine this week'])

            ]);*/
//            $notification_status = $event->notification_status;
            //        dd($device_token);
             if (($notification_status == CommonConstants::STATUS_ONLINE) && $user_id==$user_id_event) {
//              dd($user_id);
                 PushNotification::app('appNameAndroid')
                     ->to($device_token)
                     ->send('please refill your medicine this week.Your refill date is near');
             }

        }
    }
