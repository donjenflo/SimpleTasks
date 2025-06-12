<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeStatusController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::get('/employee/{id}', [EmployeeController::class, 'get']);
    Route::post('/employee', [EmployeeController::class, 'store']);
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);
    Route::put('/employee/{id}', [EmployeeController::class, 'update']);
    Route::post('/employee/{id}/role/{role_id}', [EmployeeController::class, 'assignRole']);
    Route::delete('/employee/{id}/role/{role_id}', [EmployeeController::class, 'removeRole']);

    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/employee_statuses', [EmployeeStatusController::class, 'index']);


});
