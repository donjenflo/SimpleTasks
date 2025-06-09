<?php
declare(strict_types=1);


namespace App\Repositories;


use App\DTO\GetEmployeesDTO;
use App\Filters\GetEmployeesFilter;
use App\Models\User;

class EmployeeRepository
{
 public function index(GetEmployeesDTO $employeesDTO)
 {
     return User::filter(new GetEmployeesFilter($employeesDTO))->with('employee_status')->get();
 }
}
