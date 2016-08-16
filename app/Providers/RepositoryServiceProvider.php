<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Category repo
         */
        $this->app->bind(
            \App\Repositories\Api\Category\CategoryRepository::class,
            \App\Repositories\Api\Category\CategoryRepositoryInterface::class
        );


        /*
         * Article repo
         */
        $this->app->bind(
            \App\Repositories\Api\Article\ArticleRepository::class,
            \App\Repositories\Api\Article\ArticleRepositoryInterface::class
        );


    }
}
