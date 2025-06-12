<?php

namespace App\Http\Controllers;

use App\DTO\GetTasksDTO;
use App\DTO\TaskDTO;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\IndexTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(IndexTaskRequest $request): ResourceCollection|JsonResponse
    {
        try {
            return $this->taskService->index(GetTasksDTO::fromRequest($request));
        } catch (\Exception $exception) {
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $exception->getMessage(),
                ]
            ], $exception->statusCode ?? Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $throwable->getMessage(),
                ]
            ], $throwable->statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get(int $id): TaskResource|JsonResponse
    {
        try {
            return $this->taskService->get($id);
        } catch (\Exception $exception) {
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $exception->getMessage(),
                ]
            ], $exception->statusCode ?? Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $throwable->getMessage(),
                ]
            ], $throwable->statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CreateTaskRequest $request): TaskResource|JsonResponse
    {
        try {
            return $this->taskService->store(TaskDTO::fromRequest($request));
        } catch (\Exception $exception) {
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $exception->getMessage(),
                ]
            ], $exception->statusCode ?? Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $throwable->getMessage(),
                ]
            ], $throwable->statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->taskService->destroy($id);
            return response()->json([
                'data' => 'success',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $exception->getMessage(),
                ]
            ], $exception->statusCode ?? Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $throwable->getMessage(),
                ]
            ], $throwable->statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(int $id, CreateTaskRequest $request): JsonResponse|TaskResource
    {
        try {
            return $this->taskService->update($id, TaskDTO::fromRequest($request));
        } catch (\Exception $exception) {
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $exception->getMessage(),
                ]
            ], $exception->statusCode ?? Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $throwable->getMessage(),
                ]
            ], $throwable->statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function attachEmployee(int $id, int $employeeId): JsonResponse
    {
        try {
            $this->taskService->attachEmployee($id, $employeeId);
            return response()->json([
                'data' => 'success',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $exception->getMessage(),
                ]
            ], $exception->statusCode ?? Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $throwable->getMessage(),
                ]
            ], $throwable->statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function detachEmployee(int $id, int $employeeId): JsonResponse
    {
        try {
            $this->taskService->detachEmployee($id, $employeeId);
            return response()->json([
                'data' => 'success',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $exception->getMessage(),
                ]
            ], $exception->statusCode ?? Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $throwable->getMessage(),
                ]
            ], $throwable->statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateStatus(int $id, int $statusId): JsonResponse
    {
        try {
            $this->taskService->updateStatus($id, $statusId);
            return response()->json([
                'data' => 'success',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $exception->getMessage(),
                ]
            ], $exception->statusCode ?? Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $throwable->getMessage(),
                ]
            ], $throwable->statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
