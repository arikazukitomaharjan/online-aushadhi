<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LogoutNotificationEvent extends Event
{

    use SerializesModels;

    public $device_token;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($device_token)
    {

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
