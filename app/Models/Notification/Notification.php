<?php

    namespace App\Models\Notification;

    use Davibennun\LaravelPushNotification\Facades\PushNotification;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Notification extends Model
    {

        //    use SoftDeletingTrait;

        protected $table      = 'tbl_notification';

        public    $timestamps = TRUE;

        protected $guarded    = [];

        //for laravel 4.2 only
        //    protected $softDelete = true;

        protected $hidden = ['time'];

        //for laravel 5.0 and above
//        use SoftDeletes;





    }
