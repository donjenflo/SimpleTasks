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
use Spatie\Permission\Models\Role;

class EmployeeRepository
{
    public function index(GetEmployeesDTO $employeesDTO): ResourceCollection
    {
        $users = User::filter(new GetEmployeesFilter($employeesDTO))->with(['employee_status', 'roles'])
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

    public function get(int $id): EmployeeResource
    {
        $employee = User::query()->with(['employee_status', 'roles'])->find($id);
        if (!$employee) {
            throw new EntityNotFoundException('Employee not found');
        }
        return new EmployeeResource($employee);
    }

    public function assignRole(int $id, int $roleId): void
    {
        $employee = User::query()->find($id);
        if (!$employee) {
            throw new EntityNotFoundException('Employee not found');
        }
        $role = Role::findById($roleId, 'api');
        $employee->assignRole($role);
    }

    public function removeRole(int $id, int $roleId): void
    {
        $employee = User::query()->find($id);
        if (!$employee) {
            throw new EntityNotFoundException('Employee not found');
        }
        $role = Role::findById($roleId, 'api');
        $employee->removeRole($role);
    }
}
