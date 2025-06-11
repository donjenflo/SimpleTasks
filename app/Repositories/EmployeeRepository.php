<?php
declare(strict_types=1);


namespace App\Repositories;


use App\DTO\EmployeeDTO;
use App\DTO\GetEmployeesDTO;
use App\Exceptions\EntityNotFoundException;
use App\Filters\GetEmployeesFilter;
use App\Http\Resources\EmployeeResource;
use App\Models\EmployeeStatus;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeRepository
{
    public function index(GetEmployeesDTO $employeesDTO): ResourceCollection
    {
        $users = User::filter(new GetEmployeesFilter($employeesDTO))->with('employee_status')
            ->orderBy($employeesDTO->orderBy ?? 'id', $employeesDTO->orderDirection ?? 'asc')
            ->paginate(10);
        return EmployeeResource::collection($users);
    }

    public function store(EmployeeDTO $createEmployeeDTO): EmployeeResource
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

    public function destroy(int $id): void
    {
        $user = User::query()->find($id);
        if (!$user) {
            throw new EntityNotFoundException('Employee not found');
        }
        $user->delete();
    }

    public function update(int $id, EmployeeDTO $updateEmployeeDTO): EmployeeResource
    {
        $employee = User::query()->find($id);
        if (!$employee) {
            throw new EntityNotFoundException('Employee not found');
        }
        $employee->update([
            'name' => $updateEmployeeDTO->name,
            'email' => $updateEmployeeDTO->email,
            'password' => bcrypt($updateEmployeeDTO->password),
        ]);
        return new EmployeeResource($employee);
    }

}
