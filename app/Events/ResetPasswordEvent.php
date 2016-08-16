<?php

namespace App\Events;

use App\Events\Event;
use App\Models\User\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ResetPasswordEvent extends Event
{
    use SerializesModels;
    public $data;
    public $hash;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data,$hash)
    {
       $this->data=$data;
       $this->hash=$hash;

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
