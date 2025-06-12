<?php
declare(strict_types=1);


namespace App\Services;

use App\DTO\GetTasksDTO;
use App\DTO\TaskDTO;
use App\Events\TaskStatusChanged;
use App\Exceptions\BadConditionException;
use App\Exceptions\EntityNotFoundException;
use App\Http\Resources\TaskResource;
use App\Models\EmployeeStatus;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskService
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index(GetTasksDTO $getTasksDTO): ResourceCollection
    {
        return $this->taskRepository->index($getTasksDTO);
    }

    public function get(int $id): TaskResource
    {
        return $this->taskRepository->get($id);
    }

    public function store(TaskDTO $taskDTO): TaskResource
    {
        return $this->taskRepository->store($taskDTO);
    }

    public function update(int $id, TaskDTO $taskDTO): TaskResource
    {
        return $this->taskRepository->update($id, $taskDTO);
    }

    public function destroy(int $id): void
    {
        $this->taskRepository->destroy($id);
    }

    public function attachEmployee(int $id, int $employeeId): void
    {
        $this->checkAttachEmployeeCondition($employeeId);
        $this->taskRepository->attachEmployee($id, $employeeId);
    }

    public function detachEmployee(int $id, int $employeeId): void
    {
        $this->taskRepository->detachEmployee($id, $employeeId);
    }

    public function updateStatus(int $id, int $statusId): void
    {
        $this->taskRepository->updateStatus($id, $statusId);
        event(new TaskStatusChanged(Task::query()->find($id), $statusId));

    }


    private function checkAttachEmployeeCondition(int $employeeId): void
    {
        $employee = User::query()->find($employeeId);
        if (!$employee) {
            throw new EntityNotFoundException('Employee not found');
        }
        if ($employee->employee_status_id === EmployeeStatus::VACATION_STATUS_ID) {
            throw new BadConditionException('Нельзя назначить задачу, на сотрудника в отпуске');
        }
    }


}
