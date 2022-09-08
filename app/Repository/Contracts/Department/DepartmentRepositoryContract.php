<?php


namespace App\Repository\Contracts\Department;


use App\Repository\Contracts\RepositoryContract;

interface DepartmentRepositoryContract extends RepositoryContract
{
    public function departmentIndex();
    public function getDepartment($id);
    public function createDepartment(array $data);
    public function updateDepartment($id, array $data);
    public function deleteDepartment($id);
}