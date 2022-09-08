<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Repository\Department\DepartmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    protected $departmentRepo;
    
    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $departments = $this->departmentRepo->departmentIndex();
        return response()->json($departments);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "department_name" => "string|required",
            "description" => "string|required"
        ]);
        $data = $request->all();
        $department = DB::transaction(function () use ($data) {
            return $this->departmentRepo->createDepartment($data);
        });
    
        return response()->json($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $department = $this->departmentRepo->getDepartment($id);
        return response()->json($department);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $department = $this->departmentRepo->updateDepartment($id, $request->all());
        return response()->json($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $department = $this->departmentRepo->deleteDepartment($id);
        return response()->json($department);
    }
}
