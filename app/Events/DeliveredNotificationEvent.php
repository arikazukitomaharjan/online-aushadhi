<?php

    namespace App\Events;

    use App\Events\Event;
    use App\Models\Device\Device;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

    class DeliveredNotificationEvent extends Event
    {

        use SerializesModels;

        /**
         * Create a new event instance.
         *
         * @return void
         */
        public $device_token;





        public function __construct($device_token)
        {

            //
//            dd($device_token);
            $this->device_token = $device_token;

        }





        /**
         * Get the channels the event should be broadcast on.
         *
         * @return array
         */
        public function broadcastOn()
        {

            return [];
        }
    }
