<?php
declare(strict_types=1);


namespace App\Repositories;


use App\DTO\GetEmployeesDTO;
use App\Filters\GetEmployeesFilter;
use App\Http\Resources\EmployeeResource;
use App\Models\User;

class EmployeeRepository
{
    public function index(GetEmployeesDTO $employeesDTO)
    {
        $users = User::filter(new GetEmployeesFilter($employeesDTO))->with('employee_status')
            ->orderBy($employeesDTO->orderBy ?? 'id', $employeesDTO->orderDirection ?? 'asc')
            ->paginate(10);
        return EmployeeResource::collection($users);
    }


}
