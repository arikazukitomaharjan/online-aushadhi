<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 5/10/16
 * Time: 10:40 AM
 */

namespace App\Models\User;


trait UserTrait
{
    public function authRules()
    {
        return [
            'email'    => 'required',
            'password' => 'required' // In login it is unusual to say password length.
        ];
    }
    public function test(){
        return 'hello testclude  new in';
    }
}