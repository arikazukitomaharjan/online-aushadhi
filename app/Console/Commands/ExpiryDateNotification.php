<?php

    namespace App\Console\Commands;

    use App\Events\ExpiryDateNotificationEvent;
    use App\Models\Device\Device;
    use App\Models\Notification\Notification;
    use App\Models\User\User;
    use App\Providers\Constants\CommonConstants;
    use Carbon\Carbon;
    use Illuminate\Console\Command;
    use App\Repositories\Api\Sale\SaleRepository as Sale;
    use App\Repositories\Api\Order\OrderRepository as OrderApp;
    use Illuminate\Support\Facades\Auth;
    use Log;
    use Tymon\JWTAuth\Facades\JWTAuth;

    class ExpiryDateNotification extends Command
    {

        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'check:expiry';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Checks expiry of medicine and sends mail to user if it is going to expire within this week';





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
         * @param User         $user
         * @param Sale         $sale
         * @param Device       $device
         *
         * @param Notification $notification
         *
         * @return mixed
         */
        public function handle(User $user , Sale $sale , Device $device , Notification $notification)
        {

            /* $dt = Carbon::create(2012, 1, 31, 01, 01, 03);
             dd("date=" . $dt . "<br>" . "1 week before date=" . $dt->subDays(7));*/
            //            $userid = Auth::id();
            //            $userid = $user->lists('id');
            //echo $userid;
            $dt = $sale->getRefilDate();

            
            //        $d = $dt->pluck('refill_date');
            //        $d = $dt->pluck('refill_date');

            foreach ($dt as $a) {
                $dts = Carbon::createFromFormat('Y-m-d' , $a->refill_date);
                $medicine_name = $a->medicine_name;
                //                $id = $a->id;

                $quantity = $a->quantity;
                $sales_id = $a->id;

                $refill_date_notification = $dts->subDays(7);
                $refill_date_notification = $refill_date_notification->format('Y-m-d');
//                                                            echo $refill_date_notification;
                $date = Carbon::now();

                $due_date = $date->format('Y-m-d');

                if ($due_date == $refill_date_notification) {
                    //dd('hdsaif');
                    //                    $device_token = Auth::user()->device_token;
                    //                    $device_token = Auth::User()->id;
                    //                    $user = JWTAuth::parseToken()->toUser();
                    //                    $userid = $user->lists('id');

                    //                                        echo $userid;
                    //                    $userid = $user->id;

                    $userid = $user->lists('id');

                    $devices = $device->select('tbl_device.device_token' , 'tbl_device.user_id' , 'tbl_device.notification_status')->join('tbl_client' , 'tbl_client.id' , '=' , 'tbl_device.user_id')->get();

                    foreach ($devices as $device) {

                        $device_token = $device->device_token;

                        $device_notification = $device->notification_status;

                        $user_id = $device->user_id;
                        event(new ExpiryDateNotificationEvent($device_token , $device_notification , $user_id));
                        $time = Carbon::now();

                        //


                        $notification = $notification->create([
                            'message_name'      => 'please refill your medicine this week .Your refill date is near.Your refill date is near' ,
                            'message_body'      => "Medicine name : " . $medicine_name . ',' . 'Quantity :' . $quantity ,
                            'user_id'           => $user_id ,
                            'created_at'        => $time ,
                            'sales_id'          => $sales_id ,
                            'notification_type' => CommonConstants::REFILL_NOTIFICATION
                        ]);
                    }
                    echo $devices;
                    

                    /* $device_token = $event->device_token;


                     PushNotification::app('appNameAndroid')
                         ->to($device_token)
                         ->send('Hello nisan pasa');*/

                }
            }

            //        }

            /*   $dt=Carbon::createFromFormat('d/m/Y',$dt);

               $dt=$dt->subDays(7);*/
            /* $dt = new Carbon($dt->refill_date);
             dd($dt);*/
            /*$dt=Carbon::create($year, $month, $day, $hour, $minute, $second, $tz);
            $dt = Carbon::create(['refill'=>$refill]);
    //       $expire=$dt->format('M d Y');
        $refills=$dt->subDays(7);
            dd($refills);*/
            //

        }
    }
