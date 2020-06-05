<?php

namespace App\Providers;

use App\Repositories\Interfaces\PostsRepositoryInterface;
use App\Repositories\PostsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PostsRepositoryInterface::class,PostsRepository::class);
    }
}
