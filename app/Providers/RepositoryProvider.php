<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    protected $binds = [
       \App\Repository\Contracts\User\UserRepositoryContract::class => \App\Repository\User\UserRepository::class,
       \App\Repository\Contracts\Role\RoleRepositoryContract::class => \App\Repository\Role\RoleRepository::class
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach($this->binds as $contract => $class)
        $this->app->bind($contract, $class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
