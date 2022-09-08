<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Repository\Employee\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    protected  $employeeRepo;
    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->employeeRepo->employeeIndex());
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
            "employee_name" => "string|required",
            "contact_number" => "string|required",
            "email" => "string|required"
        ]);
        $data = $request->all();
        $employee = DB::transaction(function () use ($data){
            return $this->employeeRepo->addEmployee($data);
        });
        
        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json($this->employeeRepo->getEmployee($id));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        return response()->json($this->employeeRepo->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return response()->json($this->employeeRepo->deleteEmployee($id));
    }
}
