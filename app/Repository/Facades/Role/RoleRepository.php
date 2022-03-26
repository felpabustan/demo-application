<?php
namespace App\Repository\Facades\Role;

use App\Repository\Contracts\Role\RoleRepositoryContract;
use Illuminate\Support\Facades\Facade;

class RoleRepository extends Facade{
  public static function getFacadeAccessor(){
    return RoleRepositoryContract::class;
  }
}