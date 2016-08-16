<?php

namespace App\Listeners;

use App\Events\RegistrationEvent;


use App\Models\User\User;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;

class RegistrationListner
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    //public $mailer;


    public function __construct()
    {

       // $this->mailer = $mailer;

    }

    /**
     * Handle the event.
     *
     * @param  RegistrationEvent $event
     * @param Input $input
     * @return
     * @internal param UserApp $user
     */
    public function handle(RegistrationEvent $event)
    {
        //dd($event->user);
        //dd('event fire');
        //return $this->user->confirmEmail($event->user->id);

        // $user     = $request->get('email');
        //dd($user);
        //$user = $user->find($id);

        $user = $event->user;
        //dd($user);
        //dd($user);
        
        //$confirmation_code=md5(rand(0,10));

        $data = [
            'user' => $user
            //'confirmation_code'=>$confirmation_code

        ];
       // dd($data);

        return Mail::send('email.confirm', $data, function ($m) use ($user) {

            //dd($user->email);
            $m->from('info@dac.com', 'noreply@onlineaushadhi.com');
            $m->to($user->email)->subject(' Signup | Verification');
        });
    }
}
