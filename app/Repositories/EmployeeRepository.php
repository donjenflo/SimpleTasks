<?php
declare(strict_types=1);


namespace App\Repositories;


use App\DTO\CreateEmployeeDTO;
use App\DTO\GetEmployeesDTO;
use App\Filters\GetEmployeesFilter;
use App\Http\Resources\EmployeeResource;
use App\Models\EmployeeStatus;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Hash;

class EmployeeRepository
{
    public function index(GetEmployeesDTO $employeesDTO): ResourceCollection
    {
        $users = User::filter(new GetEmployeesFilter($employeesDTO))->with('employee_status')
            ->orderBy($employeesDTO->orderBy ?? 'id', $employeesDTO->orderDirection ?? 'asc')
            ->paginate(10);
        return EmployeeResource::collection($users);
    }

    public function create (CreateEmployeeDTO $createEmployeeDTO):EmployeeResource
    {
        $employee = User::query()->create([
            'name' => $createEmployeeDTO->name,
            'email' => $createEmployeeDTO->email,
            'password' => bcrypt($createEmployeeDTO->password),
            'employee_status_id' => EmployeeStatus::WORK_STATUS_ID
            ]
        );
        return new EmployeeResource($employee);
    }


}
