<?php

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\Controller;
use App\Repositories\Api\Article\ArticleRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{
    private $article;
    public function __construct(ArticleRepositoryInterface $article)
    {
        $this->article=$article;
    }

    /**
     *
     */
    public function index(){
       $this->article->index();

    }
    public function store(){

    }
    public function update(){

    }
    public function delete(){

    }
}
