<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ExpiryDateNotificationEvent extends Event
{
    use SerializesModels;


    public $device_token;
    public $device_notification;
    public $user_id;
    public function __construct($device_token,$device_notification,$user_id)
    {
        //
        
        $this->device_token=$device_token;
        $this->device_notification=$device_notification;
        $this->user_id=$user_id;

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
