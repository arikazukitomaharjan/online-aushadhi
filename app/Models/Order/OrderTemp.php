<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderTemp extends Model
{
    protected $table='tbl_temporder';
    protected $guarded=[];
    public $timestamps = false;
}
