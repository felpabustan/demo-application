<?php

namespace App\Repository\Department;


use App\Models\Department;
use App\Repository\Model;

class DepartmentRepository extends \App\Repository\Repository implements \App\Repository\Contracts\Department\DepartmentRepositoryContract
{
    protected  $model;
    public function __construct()
    {
        $this->model = new Department();
    }
    
    public function departmentIndex()
    {
        return  $this->model->paginate(10);
    }
    
    public function getDepartment($id)
    {
        return $this->model->find($id);
    }
    
    public function createDepartment(array $data)
    {
       $department =  $this->create($data);
       
       return $this->getDepartment($department->id);
       
    }
    
    public function updateDepartment($id, array $data)
    {
       $department = $this->update($id, $data);
       return $this->getDepartment($department->id);
    }
    
    public function deleteDepartment($id)
    {
        $action = $this->delete($id);
        if($action) return ["message" => "Department deleted."];
    }
}