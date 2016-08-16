<?php

namespace App\Repositories\Api\Auth;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

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
class AuthRepository extends Repository {

    /**
     * @return string
     */
    function model() {

        return 'App\Models\User\User';
    }

    function authenticate($email, $password) {

        return $this->makeModel()->where('email', '=', $email)->where('password', '=', $password)->first();
    }





    function authenticateCheckActive($email , $password)
    {

        return $this->makeModel()->where('email' , '=' , $email)->where('password' , '=' , $password)->where('active' , '=' , 1)->first();
    }





    function authenticateSuccess($email , $password)
    {

        return $this->makeModel()->where('email' , '=' , $email)->where('password' , '=' , $password)->where('active' , '=' , 1)->first();
    }


    public function findByEmailID($email){
        return $this->makeModel()
            ->select('email')
            ->where('email','=',$email);
    }
    public function checkInDB($email){
        return $this->makeModel()
            ->where('email','=',$email)->first();
    }
}