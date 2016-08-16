<?php
    namespace App\Repositories\Api\Sale;

    use Bosnadev\Repositories\Contracts\RepositoryInterface;
    use Bosnadev\Repositories\Eloquent\Repository;
    use DB;

    /**
     * Class ArticleRepository
     *
     * @package app\Repository
     */


    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 5/10/16
     * Time: 10:29 AM
     */
    class SaleRepository extends Repository
    {

        /**
         * @return string
         */
        function model()
        {

            return 'App\Models\Sales\Sales';
        }





        public function getRefilDate()
        {

            return $this->makeModel()
                ->join('tbl_order' , 'tbl_order.sales_id' , '=' , 'tbl_sales.id')
                ->select('tbl_sales.id' , 'tbl_sales.refill_date' , 'tbl_order.medicine_name' , 'tbl_order.quantity' , 'tbl_order.medicine_type')
                //            ->where('client_id','=',$user)
                ->where('tbl_order.medicine_type' , '=' , 'regular')
                ->orderBy('tbl_sales.refill_date')
                ->get();
        }





        public function getOrderNotification($sales_id , $userid)
        {

            return $this->makeModel()
                ->join('tbl_order' , 'tbl_order.sales_id' , '=' , 'tbl_sales.id')
                ->select('tbl_sales.id' , 'tbl_sales.refill_date' , 'tbl_sales.delivery_date' , 'tbl_order.medicine_name' , 'tbl_order.quantity' , 'tbl_order.medicine_type')
                ->where('tbl_sales.id' , '=' , $sales_id)
                ->where('tbl_sales.client_id' , '=' , $userid)
                ->where('tbl_order.medicine_type' , '=' , 'regular')
                ->get();
        }





        public function getDeliveredTime()
        {

            return $this->makeModel()
                ->join('tbl_order' , 'tbl_order.sales_id' , '=' , 'tbl_sales.id')
                ->select('tbl_sales.id' , 'tbl_sales.delivery_date' , 'tbl_order.medicine_name' , 'tbl_order.quantity')
                ->orderBy('tbl_sales.delivery_date')
                ->get();
        }
    }
