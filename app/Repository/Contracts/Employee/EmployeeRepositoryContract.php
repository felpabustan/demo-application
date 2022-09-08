<?php


namespace App\Repository\Contracts\Employee;


use App\Repository\Contracts\RepositoryContract;

interface EmployeeRepositoryContract extends RepositoryContract
{
    public function employeeIndex();
    public function getEmployee($id);
    public function addEmployee(array $data);
    public function updateEmployee($id, array $data);
    public function deleteEmployee($id);
}