<?php
namespace App\Repository\User;

use App\Models\User;
use App\Repository\Contracts\User\UserRepositoryContract;
use App\Repository\Repository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository implements UserRepositoryContract{
  protected $model;
  public function __construct()
  {
    $this->model = new User();
  }
  public function getUsers(){
    return $this->model->with('role')->paginate(10);
  }
  
  public function getUser($id){
    $user = $this->model->find($id);
    
    return $user;
  }

  public function createUser(array $data){
   $data["password"] = Hash::make($data["password"]);
   
   $user = new User();

   $user->name  = $data["full_name"];
   $user->email = $data["email"];
   $user->password = $data["password"];
   $user->role_id = isset($data["role_id"]) ? $data["role_id"] : null;
   $user->save();

   return $this->getUser($user->id);
  }

  public function updateUser($id, array $data){
    $user = $this->update($id, $data);
    return $this->getUser($id);
  }
  
  public function deleteUser($id){
    $user = $this->delete($id);
    if($user)
      return ["message" => "User successfully deleted."];
  }
}