<?php

namespace App\Console\Commands;

use App\Models\Device\Device;
use Davibennun\LaravelPushNotification\Facades\PushNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class NotifyEveryMinute extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


      /*  PushNotification::app('appNameAndroid')
            ->to("cBq_xWW94lc:APA91bFwSE29UpiukJFbrwqXRbgC9L2AMKSVPC4iI6dUdkifyQQ4sKS8Ad9_x929jJ6-1p91Av1DG-hbCQVAizkqVjuArsks_sjcUYDtOGUW5IWw2Wk82jjZBOAN49wUlhaRslxDxv9i")
            ->send('Hello dude');*/
//        \Log::info('i was here');
        /*$device_token = Auth::User()->device_token;
        dd($device_token);
        event(new LoginNotificationEvent("dr_-ArsUhzg:APA91bE3FLzYdBEKq-E-iFQ-OL-5aFzipqZdMrAka8rSrbtWc0LuXnohhftWEEC4W40uU2UzT7gRmg7aX8q6QHDTY6iiW1REDW_jtvidiPvrJEgL41ZC9PCBJ6rtYdrqp1fcwknegq_W"));
    */

    }
}
