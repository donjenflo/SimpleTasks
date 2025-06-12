<?php
declare(strict_types=1);


namespace App\Repositories;

use App\Http\Resources\EmployeeStatusResource;
use App\Models\EmployeeStatus;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeStatusRepository
{
    public function index(): ResourceCollection
    {
        return EmployeeStatusResource::collection(EmployeeStatus::all());
    }
}
