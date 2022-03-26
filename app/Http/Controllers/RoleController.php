<?php

namespace App\Http\Controllers;

use App\Repository\Role\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
   protected $roleRepo;

   public function __construct(RoleRepository $roleRepo)
   {
        $this->roleRepo = $roleRepo;
   }

   public function index(){
    $roles = $this->roleRepo->getRoles();
    return response()->json($roles);
   }

   public function store(Request $request){
    $this->validate($request, [
        "role_name" => "string|required",
        "description" => "string|required"
    ]);

    $data = $request->all();

    $role = DB::transaction(function () use ($data){
        return $this->roleRepo->createRole($data);
    }, 2);

    return response()->json($role);
   }

   public function update(Request $request, $id){
    $data = $request->all();

    $role = $this->roleRepo->updateRole($id, $data);

    return response()->json($role);
   }

   public function show($id){
    $role = $this->roleRepo->getRole($id);
    return response()->json($role);
   }

   public function destroy($id){
    $role = $this->roleRepo->deleteRole($id);
    return response()->json($role);
   }
}
