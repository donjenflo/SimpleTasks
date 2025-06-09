<?php

namespace App\Http\Controllers;

use App\DTO\GetEmployeesDTO;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function index(Request $request)
    {
        return $this->employeeRepository->index(GetEmployeesDTO::fromRequest($request));
    }


}
