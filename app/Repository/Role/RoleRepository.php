<?php
namespace App\Repository\Role;

use App\Models\Role;
use App\Repository\Contracts\Role\RoleRepositoryContract;
use App\Repository\Repository;

class RoleRepository extends Repository implements RoleRepositoryContract{
  protected $model;
  public function __construct()
  {
    $this->model = new Role();
  }
  public function getRoles(){
    $roles = $this->model->paginate(10);

    return $roles;
  }

  public function getRole($id)
  {
    $role = $this->model->find($id);

    return $role;
  }

  public function createRole(array $data){
    $role = new Role();

    $role->role_name = $data["role_name"];
    $role->description = $data["description"];
    $role->save();
    
    return $this->getRole($role->id);
  }
  
  public function updateRole($id, array $data){
    $role = $this->update($id, $data);

    return $this->getRole($role->id);
  }

  public function deleteRole($id){
    $role = $this->delete($id);

    if($role)
      return ["message" => "Role deleted."];
  }
}