<?php
namespace App\Repository\Contracts\User;

use App\Repository\Contracts\RepositoryContract;

interface UserRepositoryContract extends RepositoryContract{
  public function getUsers();
  
  public function getUser($id);

  public function createUser(array $data);

  public function updateUser($id, array $data);
  
  public function deleteUser($id);

}