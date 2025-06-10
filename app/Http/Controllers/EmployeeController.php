<?php

namespace App\Http\Controllers;

use App\DTO\CreateEmployeeDTO;
use App\DTO\GetEmployeesDTO;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\IndexEmployeeRequest;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function index(IndexEmployeeRequest $request)
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
            ], $exception?->statusCode ?? Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $throwable->getMessage(),
                ]
            ], $throwable?->statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(CreateEmployeeRequest $request)
    {
        try {
            return $this->employeeRepository->create(CreateEmployeeDTO::fromRequest($request));
        } catch (\Exception $exception) {
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $exception->getMessage(),
                ]
            ], $exception?->statusCode ?? Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            return response()->json([
                'data' => '',
                'message' => [
                    'title' => 'Ошибка',
                    'body' => $throwable->getMessage(),
                ]
            ], $throwable?->statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



}
