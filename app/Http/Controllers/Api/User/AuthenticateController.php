<?php

    namespace App\Http\Controllers\Api\User;

    use App\Events\LoginNotificationEvent;
    use App\Events\RegistrationEvent;
    use App\Events\ResetPasswordEvent;
    use App\Exceptions\DBTransactionException;
    use App\Exceptions\GeneralException;
    use App\Exceptions\InvalidJsonException;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Api\AuthenticateAndRegister\CreateDeviceRequest;
    use App\Http\Requests\Api\AuthenticateAndRegister\CreatePasswordResetRequest;
    use App\Models\Device\Device;
    use App\Models\Notification\Notification;
    use App\Models\User\User;
    use App\Providers\Constants\ApiConstants;
    use App\Http\Requests\Api\AuthenticateAndRegister\CreateAuthenticationRequest;
    use App\Http\Requests\Api\AuthenticateAndRegister\CreateRegistrationRequest;
    use App\Providers\Constants\CommonConstants;
    use App\Repositories\Api\Auth\AuthRepository as UserApp;
    use App\Http\Requests\Api\RegistrationRequests;

    use App\Http\Requests;
    use Carbon\Carbon;
    use Davibennun\LaravelPushNotification\Facades\PushNotification;
    use Illuminate\Contracts\Validation\ValidationException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    use Illuminate\Support\Facades\DB;
    use Psy\Exception\ErrorException;
    use Tymon\JWTAuth\Exceptions\JWTException;

    use Tymon\JWTAuth\Facades\JWTAuth;

    class AuthenticateController extends Controller
    {

        /**
         * Authentication
         * Exception handling
         *
         * @param CreateUserAuthenticationRequest|CreateAuthenticationRequest|Request $request
         * @param User|UserApp                                                        $user
         *
         * @param Device                                                              $device
         *
         * @return mixed
         * @throws GeneralException
         */
        public function authenticate(Notification $notification , CreateDeviceRequest $requestDevice , CreateAuthenticationRequest $request , UserApp $user , Device $device)
        {

            try {

                // dd($request->all());
                $email = $request->email;

                $device_id = $requestDevice->device_id;
                $device_token = $requestDevice->device_token;
                $device_type = $requestDevice->device_type;
                $password = md5($request->password);
                $emails = $user->checkInDB($email);

                if (!$emails) {
                    throw new GeneralException('User doesnot exist.Please signup first');
                }
                $userRegister = $user->authenticateCheckActive($email , $password);
                //                $userRegister = $user->authenticateCheckInactive($email , $password);
                $user = $user->authenticate($email , $password);

                if ($user) {
                    if (!$userRegister) {
                        throw new GeneralException('Please confirm your signup from email');
                    }

                } else {
                    throw new GeneralException('Invalid credientials.');
                }

                $token = JWTAuth::fromUser($user);

                $user->where('email' , '=' , $email)->first();
                $userid = $user->id;
                $data = [
                    'device_type'  => $device_type ,
                    'device_token' => $device_token ,
                    'device_id'    => $device_id ,
                    'user_id'      => $userid
                ];
                $newData = [
                    'device_type'         => $device_type ,
                    'device_token'        => $device_token ,
                    'device_id'           => $device_id ,
                    'user_id'             => $userid ,
                    'notification_status' => 1
                ];

                /*     $device->device_type = $device_type;
                     $device->device_token = $device_token;
                     $device->device_id = $device_id;
                     $device->user_id = $userid;*/

                // dd($devicece;
                //            $device = new Device();
                $device = $device->where('device_id' , '=' , $device_id)->first();

                //                $device = $device->where('device_id' , '=' , $device_id)->where('user_id' , '=' , $userid)->first();

                //            dd($notification_status);
                if ($device) {
                    //              dd(' i have device id');
                    $id = $device->id;
                    $device = $device->find($id);
                    //                $device = new Device();
                    $device->update($data);
                } else {
                    $device = new Device();
                    $device->create($newData);

                }

                $unreadNotificationCount = $notification->select('status')->where('status' , '=' , '0')->where('user_id' , '=' , $userid)->count();

                /* if ($notification_status == CommonConstants::STATUS_ONLINE) {
                     $time = Carbon::now();

                     $notification = $notification->create([
                         'message_name' => 'successfully login' ,
                         'message_body' => 'user has been successfully login' ,
                         'user_id'      => $userid ,
                         'created_at'   => $time,
                         'notification_type'=>CommonConstants::NOTIFICATION_TYPE_LOGIN
                     ]);
                 }*/

                //                event(new LoginNotificationEvent($device_token , $notification_status));

                $notification_status = $device->lists('notification_status');
                foreach ($notification_status as $notification) {
                    $notification = $notification;
                }

                return response()->json(['success' => TRUE , '_data' => [
                    'user'         => $user ,
                    'token'        => $token ,
                    'device_token' => $device_token ,
                    'device_id'    => $device_id ,

                    'notification_status' => $notification ,

                    'unreadNotificationCount' => $unreadNotificationCount

                ]] , ApiConstants::STATUS_OK);
            } catch
            (JWTException $e) {
                // something went wrong whilst attempting to encode the token

                return response()->json(['success' => FALSE , 'msg' => $e->getMessage()] , ApiConstants::STATUS_BAD_REQUEST);
            } catch (\ErrorException $e) {
                return response()->json(['success' => FALSE , 'msg' => $e->getMessage()]);
            }

            // all good so return the token
            return response()->json(compact('token'));
        }





        public function getJson()
        {

            return response()->json(['name' => 'test'] , 200);
        }





        /**
         *Logout
         *
         */
        public function logout($device_token , Device $device)
        {

            //            $device_token = Auth::user()->device_token;
            //        event(new LogoutNotificationEvent($device_token));
            try {
                $token = JWTAuth::getToken();
                $userid = User::find(Auth::user()->id);
                $device = $device->select('id')->where('device_token' , '=' , $device_token)->where('user_id' , '=' , $userid)->first();
                $device->delete($device);
                JWTAuth::invalidate($token);

                return response()->json(['success' => TRUE , 'msg' => 'User logged out successfully']);
            } catch (\ErrorException $e) {
                return response()->json(['success' => FALSE , 'msg' => 'Error loggin out']);
            }

        }





        /**
         * register
         */
        public function postRegister(Request $request , User $user)
        {

            //dd($request->all());
            try {
                $confirmation_code = md5(rand(0 , 10));

                $data = [
                    "fullname"        => $request->fullname ,
                    'email'           => $request->email ,
                    'password'        => md5($request->password) ,
                    'house_no'        => $request->house_no ,
                    'street_name'     => $request->street_name ,
                    'ward_no'         => $request->ward_no ,
                    'district'        => $request->district ,
                    'zone'            => $request->zone ,
                    'landline_number' => $request->landline_number ,
                    'mobile_number'   => $request->mobile_number ,
                    'hash'            => $confirmation_code ,
                    'reference'       => $request->reference ,
                    'sent_email'      => 1
                ];

                $data = $user->create($data);
                //dd($user);
                event(new RegistrationEvent($data));
            } catch (\ErrorException $ex) {

                //error handling
                return response()->json(['success' => FALSE , 'msg' => $ex->getMessage()] , ApiConstants::STATUS_INTERNAL_SERVER_ERROR);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['success' => FALSE , 'msg' => "Account already exists"] , ApiConstants::STATUS_INTERNAL_SERVER_ERROR);
            }

            return response()->json([
                'success' => TRUE ,
                'msg'     => 'User has been registered.' , '_data' => $data
            ]);

        }





        /**
         * confirm mail for registration
         */
        public function confirm($hash , User $user)
        {

            try {
                $user = $user->where('hash' , '=' , $hash)->first();

                $user->active = 1;
                //        $user->hash = null;
                $user->save();

                return response()->json(['msg' => 'Your email confirmed successfully.Now you can login to our application']);

            } catch (\ErrorException $e) {
                return response()->json(['success' => FALSE , 'msg' => 'Confirmation error']);
            }

        }





        /**
         * password reset
         *
         * @param                            $email
         * @param CreatePasswordResetRequest $request
         * @param UserApp                    $user
         *
         * @return string
         */
        public function forgotPassword($email , CreatePasswordResetRequest $request , UserApp $user)
        {

            //        $get=$request->;
            /*
                    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
                    $string = '';
                    for ($i = 0; $i < 30; $i++) {
                        $string .= $characters[rand(0, strlen($characters) - 1)];
                    }
                    $randomCode = strtoupper($string);*/
            try {
                $hash = User::where('email' , $email)->first()->hash;
                $user = User::where('email' , $email)->first();
                $data = [
                    'email'    => $request->email ,
                    'fullname' => $user->fullname ,
                    'hash'     => $hash
                ];

                event(new ResetPasswordEvent($data , $hash));

                return response()->json(['_data' => $data , 'success' => TRUE]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'user not found' , 'success' => FALSE] , ApiConstants::STATUS_INTERNAL_SERVER_ERROR);
            }

        }





        /**
         *Test notification only
         */
        public function notification($device_token , Notification $notification , CreateDeviceRequest $requestDevice)
        {

            //            $device_token = Auth::User()->device_token;
            //            dd($device_token);
            //        return response()->json(['data' => $device_token]);
            $time = Carbon::now();

            $notification = $notification->create([
                'message_name' => 'test notification' ,
                'message_body' => 'Test notification' ,
                'user_id'      => 22 ,
                'created_at'   => $time
            ]);
            PushNotification::app('appNameAndroid')
                ->to($device_token)
                ->send('first notification dude');

        }





        public function notificationDelivered(Device $device , CreateDeviceRequest $request , Notification $notification)
        {

            try {

                $user_id = $request->user_id;

                $sales_id = $request->sales_id;
                $id = [$user_id];
                $device_token = $device->whereIn('user_id' , $id)->get();

                foreach ($device_token as $device) {
                    $device_token = $device->device_token;
                    $devices = PushNotification::DeviceCollection([
                        PushNotification::Device($device_token)]);

                    PushNotification::app('appNameAndroid')
                        ->to($devices)
                        ->send('your order has been delivered. please confirm it');

                }

                $time = Carbon::now();
                /*      PushNotification::app('appNameAndroid')
                          ->to($device_token)
                          ->send('your order has been delivered. please confirm it');*/

                $notification = $notification->create([
                    'message_name'      => 'Your order has been successfully delivered. please confirm it' ,
                    'message_body'      => "Medicine name delivered successfully" ,
                    'user_id'           => $user_id ,
                    'created_at'        => $time ,
                    'sales_id'          => $sales_id ,
                    'notification_type' => CommonConstants::DELIVERED_NOTIFICATION
                ]);

                return response()->json(['data' => $notification , 'msg' => TRUE]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }





        /**
         * notification
         */
        public function notificationList($pageSize , Notification $notification)
        {

            try {
                $userid = Auth::User()->id;

                //        $time->diffForHumans();
                //
                //                $notification_status = $device->notification_status;
                $unreadNotificationCount = $notification->select('status')->where('status' , '=' , '0')->where('user_id' , '=' , $userid)->count();

                $pagination = ($pageSize - 1) * CommonConstants::NOTIFICATION_LIMIT;
                //                        dd($pagination);

                $displayNotification = $notification->where('user_id' , '=' , $userid)->skip($pagination)->take(CommonConstants::NOTIFICATION_LIMIT)->latest()->get();

                return response()->json(['_data' => $displayNotification , 'offset' => $pagination , 'success' => TRUE , 'count' => $unreadNotificationCount]);

            } catch (\ErrorException $e) {
                return response()->json(['success' => FALSE]);
            }
        }





        public function weekTest()
        {

            $dt = Carbon::create(2012 , 1 , 31 , 01 , 01 , 03);
            dd("date=" . $dt . "<br>" . "1 week before date=" . $dt->subDays(7));
        }





        /**
         * notification view
         */
        public function notificationView($id , Notification $notification)
        {

            try {
                $notification = $notification->find($id);

                //        dd($notification);
                return response()->json(['_data' => $notification , 'success' => TRUE]);
            } catch (\ErrorException $e) {
                return response()->json(['success' => FALSE]);
            }

        }





        /**
         * @param Notification $notification
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function notificationDelete(Notification $notification)
        {

            try {
                $user_id = Auth::user()->id;

                //                $notification = $notification->find($id);
                $notification = $notification->select('id')->where('user_id' , '=' , $user_id)->orderBY('created_at' , 'DESC')->get();

                $ids = $notification->toArray();

                $newArray = [];
                foreach ($ids as $key => $value) {
                    $newArray[$key] = $value['id'];
                }

                $delete = $notification->whereIn('id' , $newArray);
                $count = $notification->whereIn('id' , $newArray)->count();

                foreach ($delete as $notification) {

                    $delete = $notification->delete();  # $notification is an eloquent model and can soft-delete

                }

                //                $ids = [10 , 20 , 30];
                //                dd($newArray);

                //                $delete = DB::table('tbl_notification')->delete($newArray);

                //                $delete = $notification->destroy($ids);

                if (!$delete) {
                    throw new GeneralException('error while deleting');
                }

                /*    if($id == $notification->id){
                        return 'hello';
                    }*/

                return response()->json(['success' => TRUE , 'msg' => 'deleted successfully' , '_data' => $count , 'userid' => $user_id]);
            } catch (GeneralException $e) {
                return response()->json(['success' => FALSE , 'msg' => 'error']);
            } catch (\ErrorException $e) {
                return response()->json(['success' => FALSE , 'msg' => $e->getMessage()]);
            }

        }





        public function notificationDeleteByID($id , Notification $notification)
        {

            try {
                $user_id = Auth::user()->id;
                $notification->find($id)->delete();

                $notificationUnreadCount = $notification->where('status' , '=' , 0)->where('user_id' , '=' , $user_id)->count();

                return response()->json(['success' => TRUE , 'msg' => 'deleted successfully' , 'unreadCount' => $notificationUnreadCount]);
            } catch (\ErrorException $e) {
                return response()->json(['success' => FALSE , 'msg' => $e->getMessage()]);
            }

        }





        public function trash(Notification $notification)
        {

            $flights = $notification->withTrashed()
                ->get();

            return response()->json(['msg' => 'trash data' , '_data' => $flights]);
        }





        public function trashRestore($id , Notification $notification)
        {

            $notification = $notification->withTrashed()->find($id)->restore();

            return response()->json(['msg' => 'Restored successfully' , '_data' => $notification]);
        }





        public function trashDelete($id , Notification $notification)
        {

            $notification = $notification->find($id)->forceDelete();

            return response()->json(['msg' => 'Deleted successfully' , '_data' => $notification]);
        }





        public function notificationRead($id , Notification $notification , Device $device)
        {

            /*   $user = JWTAuth::parseToken()->toUser();
               $userid=$user->id;
               $device_detail=$device->where('user_id','=',$userid)->first();
               $device_token=$device_detail->device_token;
               echo $device_token;*/

            try {
                $id = $notification->find($id)->update([
                    'status' => CommonConstants::NOTIFICATION_READ
                ]);

            } catch (\ErrorException $ex) {
                return response()->json(['success' => FALSE , 'msg' => $ex->getMessage()] , ApiConstants::STATUS_BAD_REQUEST);
            }

            return response()->json(['msg' => 'Read' , 'success' => TRUE]);
        }
    }

