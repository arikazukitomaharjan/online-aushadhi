<?php
namespace App\Repositories\Api\Order;

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
class OrderRepository extends Repository
{

    /**
     * @return string
     */
    function model()
    {

        return 'App\Models\Order\Order';
    }

    /**
     * @param $id
     * @return mixed
     */
    function getAll($id)
    {

        return $this->makeModel()
            ->join('tbl_sales as sales', 'sales.id', '=', 'tbl_order.sales_id')
            ->select('sales.date', 'sales.delivery_date', DB::raw("sum(sales.total_amount) as total_amount"), DB::raw("count(tbl_order.id) as orderCount"), DB::raw("monthname(date) as month,month(date) as monthOrder,year(date) as year"))
            ->where('sales.client_id', '=', $id)
            ->groupBy('year', 'month')
            ->orderBy('year', 'DESC')
            ->orderBy('monthOrder', 'DESC')
            ->get();
        //return $this->makeModel()->where('type', "LIKE", $type)->orderBy('title')->paginate($count);

    }

    function getAllByOrderMonth($year, $month, $id)
    {

        return $this->makeModel()
            ->join('tbl_sales as sales', 'sales.id', '=', 'tbl_order.sales_id')
            ->select('tbl_order.sales_id', 'sales.date', 'discount_amount', 'sales.net_amount', 'sales.delivery_date', 'sales.total_amount')
            ->where('sales.client_id', '=', $id)
            ->whereRaw("year(date)= $year")
            ->whereRaw("month(date) = $month")
            ->groupBy('tbl_order.sales_id')
            ->orderBy('sales.date', 'DESC')
            ->get();

    }

    function getAllByOrderID($id)
    {

        return $this->makeModel()
            ->join('tbl_sales as sales', 'sales.id', '=', 'tbl_order.sales_id')
            ->select('tbl_order.sales_id', 'tbl_order.stock_id', 'tbl_order.medicine_name', 'tbl_order.medicine_type', 'tbl_order.quantity', 'tbl_order.status', 'tbl_order.rate', 'tbl_order.total_amount')
            ->where('tbl_order.sales_id', '=', $id)
            ->get();
    }

    function storeOrder($order)
    {

        return $this->makeModel()
            ->create($order->all());
    }

    function search($medicine_name)
    {

        return $this->makeModel()->where('medicine_name', '=', '%' . $medicine_name . '%');
    }

    function recentId($userID)
    {

        return $this->makeModel()
            ->join('tbl_sales as sales', 'sales.id', '=', 'tbl_order.sales_id')
            ->select('tbl_order.sales_id')
            ->where('sales.client_id', '=', $userID)
            ->orderBY('tbl_order.id', 'DESC')
            ->first();

//            ->where('sales_id','=',);
    }
    function recentOrder($sales_id){
        return $this->makeModel()
            ->where('sales_id','=',$sales_id)
            ->get();
    }
}