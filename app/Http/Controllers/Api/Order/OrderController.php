<?php

    namespace App\Http\Controllers\Api\Order;

    use App\Http\Requests\Api\Order\CreateOrderRequest;
    use App\Http\Requests\Api\Order\CreateOrderReviewRequest;

    use App\Http\Requests\Api\Order\CreateOrderTempRequest;
    //use App\Models\Order\OrderTemp;
    use App\Models\Order\OrderReview;
    use App\Models\Prescription\Prescription;
    use App\Repositories\Api\Order\OrderRepository as OrderApp;
    use App\Repositories\Api\Sale\SaleRepository as Sale;
    use Carbon\Carbon;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;

    class OrderController extends Controller
    {

        /**
         * @param OrderApp $order
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function getOrderHistoryByMonth(OrderApp $order)
        {

            try {
                $userid = Auth::User()->id;

                $orderHistory = $order->getAll($userid);

                return response()->json(['_data' => $orderHistory , 'success' => TRUE]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }





        /**
         * @param OrderApp $order
         * @param          $year
         * @param          $month
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function getOrderHistoryBySalesID(OrderApp $order , $year , $month)
        {

            try {
                $userid = Auth::User()->id;
                $orderHistory = $order->getAllByOrderMonth($year , $month , $userid);

                return response()->json(['_data' => $orderHistory , 'success' => TRUE]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }





        /**
         * @param OrderApp $order
         * @param          $sales_id
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function getOrderSalesDetail(OrderApp $order , $sales_id)
        {

            //$order=$order->find($sales_id);
            //$orderID=$order->sales_id;
            try {
                $orderDetail = $order->getAllByOrderID($sales_id);

                //dd($orderDetail);
                return response()->json(['_data' => $orderDetail , 'success' => TRUE]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }





        /**
         * @param OrderReview              $order
         * @param Sale                     $sale
         * @param CreateOrderReviewRequest $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function store(OrderReview $order , Sale $sale , CreateOrderReviewRequest $request)
        {

            /* $da = [
                  "medicine_name" => $request->get('medicine_name'),
                  "medicine_type" => $request->get('medicine_type'),
                  "quantity" => $request->get('quantity'),

              ];
              dd($da);
              $data = [
                  "medicine_name" => $request->medicine_name,
                  "medicine_type" => $request->medicine_type,
                  "quantity" => $request->quantity
              ];
              */
            //dd($data);
            //for sale detail
            try {
                $date = Carbon::now();
                $date = $date->format('Y-m-d');
                $userid = Auth::User()->id;
                $discount_rate = 0;
                $discount_amount = 0;
                $image_id = 0;
                $net_amounts_value = 0;
                $val_total = $discount_amount + $net_amounts_value;
                /*   $sale->client_id = 1;
                   $sale->save();*/

                $sale = $sale->create([
                    "client_id"           => $userid ,
                    "date"                => $date ,
                    "discount_percentage" => $discount_rate ,
                    "discount_amount"     => $discount_amount ,
                    "image_id"            => $image_id ,
                    "total_amount"        => $val_total ,
                    "net_amount"          => $net_amounts_value
                ]);
                $sales_id = $sale->id;

                $orderTable = $request->all();
                $newOrder = [];
                foreach ($orderTable as $key => $value) {
                    $value['sales_id'] = $sales_id;
                    $newOrder[$key] = $value;
                }
                $order = $order->insert(
                    $newOrder
                );

                return response()->json(['success' => TRUE , 'data' => $order , 'sale' => $sale , 'msg' => 'Order was successfully ordered']);

            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }
        }





        /**
         * @param                                  $medicine_name
         * @param OrderApp                         $order
         * @param CreateOrderReviewRequest|Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function autocompleteMedicine($medicine_name , OrderApp $order , CreateOrderReviewRequest $request)
        {

            try {
                $autocomplete = $order->search($medicine_name);

                return response()->json(['success' => TRUE , '_data' => $autocomplete]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => '!Error Text suggestion disabled' , 'success' => FALSE]);
            }

        }





        public function orderRecent(OrderApp $order)
        {

            try {
                $userid = Auth::User()->id;
                $sales_id = $order->recentId($userid);
                // $sale = intval($sales_id);

                $sales_id = $sales_id['sales_id'];

                $recentOrder = $order->recentOrder($sales_id);

                return response()->json(['_data' => $recentOrder , 'success' => TRUE , 'msg' => 'recent order ']);

            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }
        }





        /**
         * @param      $sales_id
         * @param Sale $sale
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function getOrderNotification($sales_id , Sale $sale)
        {

            try {
                $userid = Auth::User()->id;
                $sale = $sale->getOrderNotification($sales_id , $userid);

                return response()->json(['_data' => $sale , 'success' => TRUE]);
            } catch (\ErrorException $e) {
                return response()->json(['msg' => 'client and server out of sync' , 'success' => FALSE]);
            }

        }
    }
