<?php

namespace App\Repository\Facades\Deparment;


use App\Repository\Contracts\Department\DepartmentRepositoryContract;
use Illuminate\Support\Facades\Facade;

class DepartmentRepository extends Facade
{
    public static function getFacadeAccessor()
    {
        return DepartmentRepositoryContract::class;
    }
}