<?php
namespace App\Repositories\Api\Prescription;


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
class PrescriptionRepository extends Repository
{

    /**
     * @return string
     */
    function model()
    {

        return 'App\Models\Prescription\Prescription';
    }

}