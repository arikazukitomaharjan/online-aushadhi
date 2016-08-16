<?php
namespace App\Repositories\Api\Article;

/**
 * Created by PhpStorm.
 * User: Sabin
 * Date: 5/5/2016
 * Time: 11:07 AM
 */
interface ArticleRepositoryInterface
{
    /**
     *
     */
    public function index();

    public function store();

    public function update();

    public function delete();
}