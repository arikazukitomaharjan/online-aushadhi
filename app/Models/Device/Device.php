<?php

namespace App\Models\Device;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    protected $table = 'tbl_device';

    public $timestamps = false;

    protected $guarded = [];
//    protected $fillable = ['id', 'device_id', 'device_token', 'device_type', 'user_id'];
}
