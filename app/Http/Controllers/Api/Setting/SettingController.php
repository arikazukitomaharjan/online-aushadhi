<?php

    namespace App\Http\Controllers\Api\Setting;

    use App\Http\Requests\Api\Setting\CreateAddressDetailSettingRequest;
    use App\Http\Requests\Api\Setting\CreatePasswordSettingRequest;
    use App\Http\Requests\Api\Setting\CreatePersonalDetailSettingRequest;
    use App\Models\Device\Device;
    use App\Repositories\Api\Auth\AuthRepository as Setting;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;

    class SettingController extends Controller
    {

        /**
         * @param Setting                      $setting
         * @param CreatePasswordSettingRequest $request
         * @param                              $id
         */
        public function passwordSetting(Setting $setting , CreatePasswordSettingRequest $request , $id)
        {

            try {
                $dataPassword = md5($request->password);

                $data = $setting->find($id)->update([
                    'password' => $dataPassword
                ]);

                return response()->json([
                    'success'  => TRUE ,
                    'msg'      => 'success' ,
                    '_data'    => $data ,
                    'password' => $dataPassword
                ]);

            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }





        public function userPersonalDetailSetting($id , Setting $setting , CreatePersonalDetailSettingRequest $request)
        {

            try {
                $data = $setting->find($id)->update($request->all());

                return response()->json([
                    'success' => TRUE ,
                    'msg'     => 'success' ,
                    '_data'   => $data
                ]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }





        /**
         * @param Setting                           $setting
         * @param CreateAddressDetailSettingRequest $request
         */
        public function userAddressDetailSetting($id , Setting $setting , CreateAddressDetailSettingRequest $request)
        {

            try {
                $data = $setting->find($id)->update($request->all());

                return response()->json([
                    'success' => 'true' ,
                    'msg'     => 'success' ,
                    '_data'   => $data
                ]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }





        public function profile($id , Setting $user)
        {

            try {
                $user = $user->find($id);

                return response()->json([
                    "success" => TRUE ,
                    "msg"     => "user detail" ,
                    '_data'   => $user

                ]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }





        public function notificationSetting($value , Device $device)
        {

            try {

                $id = Auth::User()->id;

                $device = $device->whereIn('user_id' , [$id])->update(['notification_status' => $value]);
                if ($value == 0) {
                    $msg = "notificaiton is turned off";
                } else {
                    $msg = "notification is turned on";
                }

                return response()->json(["success" => TRUE , 'msg' => $msg , 'notification_status' => $value , '_data' => $device]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }
    }
