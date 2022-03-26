<?php
namespace App\Repository\Facades\User;

use App\Repository\Contracts\User\UserRepositoryContract;
use Illuminate\Support\Facades\Facade;

class UserRepository extends Facade{
  public static function getFacadeAccessor(){
    return UserRepositoryContract::class;
  }
}