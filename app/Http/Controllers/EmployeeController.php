<?php

namespace App\Http\Controllers;

use App\DTO\EmployeeDTO;
use App\DTO\GetEmployeesDTO;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\IndexEmployeeRequest;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function index(IndexEmployeeRequest $request): JsonResponse|ResourceCollection
    {
        try {
            return $this->employeeRepository->index(GetEmployeesDTO::fromRequest($request));
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

    public function store(CreateEmployeeRequest $request): JsonResponse|JsonResource
    {
        try {
            return $this->employeeRepository->store(EmployeeDTO::fromRequest($request));
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
            $this->employeeRepository->destroy($id);
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

    public function update(int $id, CreateEmployeeRequest $request): JsonResponse|JsonResource
    {
        try {
            return $this->employeeRepository->update($id, EmployeeDTO::fromRequest($request));
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

    public function get(int $id): JsonResponse|JsonResource
    {
        try {
            return $this->employeeRepository->get($id);
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

    public function assignRole(int $id, int $roleId): JsonResponse
    {
        try {
             $this->employeeRepository->assignRole($id, $roleId);
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

    public function removeRole(int $id, int $roleId): JsonResponse
    {
        try {
            $this->employeeRepository->removeRole($id, $roleId);
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
