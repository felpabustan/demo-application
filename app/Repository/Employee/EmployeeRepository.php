<?php

namespace App\Repository\Employee;


use App\Models\Employee;
use App\Repository\Model;

class EmployeeRepository extends \App\Repository\Repository implements \App\Repository\Contracts\Employee\EmployeeRepositoryContract
{
    protected  $model;
    public function __construct()
    {
        $this->model = new Employee();
    }
    
    public function employeeIndex()
    {
        return $this->model->paginate(10);
    }
    
    public function getEmployee($id)
    {
        return $this->model->find($id);
    }
    
    public function addEmployee(array $data)
    {
        $employee = $this->create($data);
        return $this->getEmployee($employee->id);
    }
    
    public function updateEmployee($id, array $data)
    {
        $employee = $this->update($id, $data);
        return $this->getEmployee($employee->id);
    }
    
    public function deleteEmployee($id)
    {
        $action = $this->delete($id);
        if($action) return ["message" => "Employee removed."];
    }
}