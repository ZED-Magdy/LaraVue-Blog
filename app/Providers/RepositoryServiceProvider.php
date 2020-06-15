<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\ApiAuthRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\PostsRepositoryInterface;
use App\Repositories\Interfaces\RolesRepositoryInterface;
use App\Repositories\Interfaces\UsersRepositoryInterface;
use App\Repositories\jwtAuthRepository;
use App\Repositories\PostsRepository;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
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
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ApiAuthRepositoryInterface::class,jwtAuthRepository::class);
        $this->app->bind(UsersRepositoryInterface::class,UsersRepository::class);
        $this->app->bind(RolesRepositoryInterface::class,RolesRepository::class);
    }
}
