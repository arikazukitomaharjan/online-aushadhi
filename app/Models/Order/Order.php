<?php

namespace App\Models\Order;

use App\Models\Sales\Sales;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table='tbl_order';
    public function sales(){
        return $this->hasMany(Sales::class);
    }
}
