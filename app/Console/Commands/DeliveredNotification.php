<?php

    namespace App\Console\Commands;

    use App\Events\DeliveredNotificationEvent;
    use App\Models\Device\Device;
    use App\Models\Notification\Notification;
    use App\Models\User\User;
    use App\Providers\Constants\CommonConstants;
    use Carbon\Carbon;
    use App\Repositories\Api\Sale\SaleRepository as Sale;

    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\Auth;

    class DeliveredNotification extends Command
    {

        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'check:delivered';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'this is made for deeliverded status checking up';





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
        public function handle(User $user , Notification $notification , Device $device , Sale $sale)
        {

            $userid = $user->lists('id');
            $dt = $sale->getDeliveredTime();

            foreach ($dt as $a) {
                //
                $delivery_date = $a->delivery_date;
                $medicine_name = $a->medicine_name;

                $quantity = $a->quantity;
                $sales_id = $a->id;

                $date = Carbon::now();

                $due_date = $date->format('Y-m-d');

                if ($due_date == $delivery_date) {

                    $user_id = $user->lists('id');

                    $devices = $device->select('device_token' , 'user_id')->join('tbl_client' , 'tbl_client.id' , '=' , 'tbl_device.user_id')->get();
                    foreach ($devices as $device) {
                        $device_token = $device->device_token;
                        $user_id = $device->user_id;
//dd($device_token.'+'.$user_id);
                        event(new DeliveredNotificationEvent($device_token));
                        $time = Carbon::now();

                        $notification = $notification->create([
                            'message_name'      => 'Your order has been successfully delivered. please confirm it' ,
                            'message_body'      => "Medicine name : " . $medicine_name . ',' . 'Quantity :' . $quantity ,
                            'user_id'           => $user_id ,
                            'created_at'        => $time ,
                            'sales_id'          => $sales_id ,
                            'notification_type' => CommonConstants::DELIVERED_NOTIFICATION
                        ]);
                    }

                }
            }
        }
    }
