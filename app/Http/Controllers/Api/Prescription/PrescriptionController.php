<?php

    namespace App\Http\Controllers\Api\Prescription;

    use App\Http\Requests\Api\Prescription\CreatePrescriptionRequest;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    //use App\Repositories\Api\Prescription\PrescriptionRepository as Prescription;
    use App\Models\Prescription\Prescription;
    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use Folklore\Image\Facades\Image;
    //use File;
    use Tymon\JWTAuth\Exceptions\JWTException;

    use Tymon\JWTAuth\Facades\JWTAuth;

    class PrescriptionController extends Controller
    {

        /**
         * @param Prescription              $prescription
         * @param CreatePrescriptionRequest $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function uploadPrescription(Prescription $prescription , CreatePrescriptionRequest $request)
        {

            //imagename
            //imagepath
            //clientid
            //date

            try {
                $rand = mt_rand(11111 , 99999);

                $imageName = $request->file('image_name');

                $user = JWTAuth::parseToken()->authenticate();
                $userid = $user->id;
                $date = Carbon::now();

                $year = $date->format('Y');
                $month = $date->format('m');
                //        $monthname = $date->format('F j, Y');
                //        dd($monthname);

                $fullName = $request->file('image_name')->getClientOriginalName();
                $ext = $request->file('image_name')->getClientOriginalExtension();
                $image = preg_replace('/\..+$/' , '' , $fullName);

                $imageName = $rand . $image . $userid . "." . $ext;
                $request->file('image_name')->move(
                    base_path("../onlineaushadhiweb/").'/upload/' . $year . "/" . $month, $imageName
                );

                $prescription = $prescription->create([
                    'client_id'  => $userid ,
                    'image_name' => $imageName ,
                    'date'       => $date ,
                    'upload_from'=>'f0',
                    'image_path' => '/uploads/' . $year . "/" . $month

                ]);

                return response()->json(['success' => TRUE , 'msg' => 'inserted successfull' , 'data' => $prescription]);

            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }
    }
