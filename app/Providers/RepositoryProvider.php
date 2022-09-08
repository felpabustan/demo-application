<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    protected $binds = [
       \App\Repository\Contracts\User\UserRepositoryContract::class => \App\Repository\User\UserRepository::class,
       \App\Repository\Contracts\Role\RoleRepositoryContract::class => \App\Repository\Role\RoleRepository::class,
       \App\Repository\Contracts\Department\DepartmentRepositoryContract::class => \App\Repository\Department\DepartmentRepository::class,
       \App\Repository\Contracts\Employee\EmployeeRepositoryContract::class => \App\Repository\Employee\EmployeeRepository::class
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
