<?php

namespace App\Models\Sales;

use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table='tbl_sales';
    protected $guarded=[];
    public $timestamps=false;
//    protected $fillable=['client_id','date','discount_percentage','discount_amount','total_amount','net_amount'];
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
