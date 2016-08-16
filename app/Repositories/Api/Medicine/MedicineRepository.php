<?php
namespace App\Repositories\Api\Medicine;


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
class MedicineRepository extends Repository
{

    /**
     * @return string
     */
    function model()
    {

        return 'App\Models\Medicine\Medicine';
    }



    function search($medicine_name){
       
        return $this->makeModel()
            ->select('medicine_name')
            ->where('medicine_name','LIKE','%'.$medicine_name.'%')->get();
    }

}