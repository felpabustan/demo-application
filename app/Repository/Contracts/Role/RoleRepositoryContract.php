<?php
namespace App\Repository\Contracts\Role;

use App\Repository\Contracts\RepositoryContract;

interface RoleRepositoryContract extends RepositoryContract{
  public function getRoles();

  public function getRole($id);

  public function createRole(array $data);
  
  public function updateRole($id, array $data);

  public function deleteRole($id);

}