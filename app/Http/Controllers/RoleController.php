<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index(): JsonResponse|ResourceCollection
    {
        try {
            return $this->roleRepository->index();
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
