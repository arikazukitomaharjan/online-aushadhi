<?php
namespace App\Repositories\Api\User;


use App\Http\Requests\Api\AuthenticateAndRegister\CreateRegistrationRequest;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\Mail;


/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 5/10/16
 * Time: 10:29 AM
 */
class UserRepository extends Repository
{

    /**
     * @return string
     */
    public $confirmation;
    function model()
    {

        return 'App\Models\User\User';
    }

    function __construct(Confirmation $confirmation)
    {
        $this->confirmation=$confirmation;

    }
    




}

