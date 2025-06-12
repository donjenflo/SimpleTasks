<?php
declare(strict_types=1);


namespace App\Repositories;

use App\DTO\GetTasksDTO;
use App\DTO\TaskDTO;
use App\Exceptions\EntityNotFoundException;
use App\Filters\GetTasksFilter;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskRepository
{
    public function index(GetTasksDTO $getTasksDTO): ResourceCollection
    {
        $tasks = Task::query()
            ->filter(new GetTasksFilter($getTasksDTO))
            ->with(['employees', 'status'])
            ->orderBy($getTasksDTO->orderBy ?? 'id', $getTasksDTO->orderDirection ?? 'asc')
            ->paginate(10);

        return TaskResource::collection($tasks);
    }

    public function store(TaskDTO $taskDTO): TaskResource
    {
        $task = Task::query()->create([
            'title' => $taskDTO->title,
            'description' => $taskDTO->description,
            'status_id' => TaskStatus::FOR_WORK_STATUS_ID,
        ]);

        return new TaskResource($task);
    }

    public function get(int $id): TaskResource
    {
        $task = Task::query()->with(['employees', 'status'])->find($id);
        if (!$task) {
            throw new EntityNotFoundException('Task not found');
        }
        return new TaskResource($task);
    }

    public function update(int $id, TaskDTO $taskDTO): TaskResource
    {
        $task = Task::query()->find($id);
        if (!$task) {
            throw new EntityNotFoundException('Task not found');
        }
        $task->update([
            'title' => $taskDTO->title,
            'description' => $taskDTO->description,
        ]);
        return new TaskResource($task);
    }

    public function destroy(int $id): void
    {
        $task = Task::query()->find($id);
        if (!$task) {
            throw new EntityNotFoundException('Task not found');
        }
        $task->delete();
    }

    public function attachEmployee(int $id, int $employeeId): void
    {
        $task = Task::query()->with(['employees', 'status'])->find($id);
        if (!$task) {
            throw new EntityNotFoundException('Task not found');
        }
        $employee = User::query()->find($employeeId);
        if (!$employee) {
            throw new EntityNotFoundException('Employee not found');
        }
        $task->employees()->attach($employee);

    }

    public function detachEmployee(int $id, int $employeeId): void
    {
        $task = Task::query()->with(['employees', 'status'])->find($id);
        if (!$task) {
            throw new EntityNotFoundException('Task not found');
        }
        $employee = User::query()->find($employeeId);
        if (!$employee) {
            throw new EntityNotFoundException('Employee not found');
        }
        $task->employees()->detach($employee);

    }

    public function updateStatus(int $id, int $statusId): void
    {
        $task = Task::query()->with(['status'])->find($id);
        if (!$task) {
            throw new EntityNotFoundException('Task not found');
        }
        if (!TaskStatus::query()->find($statusId)) {
            throw new EntityNotFoundException('Status not found');
        }
        $task->status_id = $statusId;
        $task->save();

    }
}
