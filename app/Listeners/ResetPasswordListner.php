<?php

namespace App\Listeners;

use App\Events\ResetPasswordEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class ResetPasswordListner
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  ResetPasswordEvent $event
     * @return void
     */
    public function handle(ResetPasswordEvent $event)
    {

        $user = $event->data;
        $hash = $event->hash;

        $data = [
            'user' => $user,
            'hash' => $hash,
        ];

        return Mail::Send('email.reset', $data, function ($m) use ($user) {

            $m->from('info@dac.com', 'noreply@onlineaushadhi.com');
            $m->to($user['email'])->subject('reset password');
        });
    }
}
