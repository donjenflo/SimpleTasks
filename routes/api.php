<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeStatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/employee_statuses', [EmployeeStatusController::class, 'index']);

    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::get('/employee/{id}', [EmployeeController::class, 'get']);
    Route::post('/employee', [EmployeeController::class, 'store']);
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);
    Route::put('/employee/{id}', [EmployeeController::class, 'update']);
    Route::post('/employee/{id}/role/{role_id}', [EmployeeController::class, 'assignRole']);
    Route::delete('/employee/{id}/role/{role_id}', [EmployeeController::class, 'removeRole']);
    Route::put('/employee/{id}/status/{employee_status_id}', [EmployeeController::class, 'updateEmployeeStatus']);

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/task/{id}', [TaskController::class, 'get']);
    Route::post('/task', [TaskController::class, 'store'])->middleware('throttle:2,1');
    Route::delete('/task/{id}', [TaskController::class, 'destroy']);
    Route::put('/task/{id}', [TaskController::class, 'update']);
    Route::put('/task/{id}/status/{task_status_id}', [TaskController::class, 'updateStatus']);
    Route::post('/task/{id}/employee/{employee_id}', [TaskController::class, 'attachEmployee']);
    Route::delete('/task/{id}/employee/{employee_id}', [TaskController::class, 'detachEmployee']);


});
