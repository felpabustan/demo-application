<?php

namespace App\Http\Controllers;

use App\Repository\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo;
    
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function index(){
        $users = $this->userRepo->getUsers();
        return response()->json($users);
    }
 
    public function store(Request $request){
        $this->validate($request, [
            "full_name" => "string|required|unique:users,name",
            "email" => "string|required|unique:users",
            "password" => "string|required|same:confirm_password|min:8",
            "confirm_password" => "string|required|min:8"
        ]);
        $data = $request->all();
        $user = $this->userRepo->createUser($data);

        return response()->json($user);
    }
 
    public function update(Request $request, $id){
        $this->validate($request, [
            "full_name" => "string|required",
            "email" => "string|required",
        ]);
        $data = $request->all();
        $user = $this->userRepo->updateUser($id, $data);

        return response()->json($user);
    }
 
    public function show($id){
        $user = $this->userRepo->getUser($id);
        return response()->json($user);
    }
 
    public function destroy($id){
        $user = $this->userRepo->deleteUser($id);
        return response()->json($user);
    }

    
}
