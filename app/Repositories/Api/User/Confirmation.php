<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 5/23/16
 * Time: 5:54 PM
 */

namespace App\Repositories\Api\User;


use Illuminate\Support\Facades\Mail;

class Confirmation
{
    public function sendTo($email, $subject, $view, $data = array())
    {
        \Mail::queue($view, $data, function($message) use($email, $subject)
        {

            $message->from('Online Aushadhi','DAC');
            $message->to($email)->subject($subject);
        });
        return "Mail has been sent";

    }

    /*return Mail::send('email.users.registered-by-admin', $data, function ($m) use ($user) {
                    $m->from('support@petntie.com', 'Pet-&-Tie');
                    $m->to($user->email, $user->name)->subject('Your account has been created');
                });*/


    public function confirmMail()
    {
        $subject = "Confirmation email !";
        $data['name'] = $formData['name'];
        $data['email'] = $formData['email'];
        $data['mobile'] = $formData['mobile'];
        $data['subject'] = $formData['subject'];
        $data['bodymessage'] = $formData['message'];
        $view = 'email.confirm';
        return $this->sendTo($email,$subject,$view,$data);

    }





}