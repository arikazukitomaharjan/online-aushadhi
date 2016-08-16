<?php

namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tbl_client';
    protected $guarded=[];
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /*  public function setPasswordAttribute($password)
      {
          $this->attributes['password'] = bcrypt($password);
      }*/
}
