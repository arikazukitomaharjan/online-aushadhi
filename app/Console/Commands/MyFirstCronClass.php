<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 5/12/16
 * Time: 10:18 AM
 */

namespace App\Console\Commands;



use App\User;
use Illuminate\Console\Command;

class MyFirstCronClass extends Command
{
    protected $name='command:check';

    protected $description='Do something with my crfon job';

    public function handle(){
        //well nothing yet

        $this->info('Display this on the screen');
        
       /* $user = new  User();
        $user->fullname = 'test user android';
        $user->email = 'xyzhbgjhbgbh.com';
        $user->password = '123';
        //dd($user);
        $user->save();*/
        
       /* print('hellowhat');*/
    }



}