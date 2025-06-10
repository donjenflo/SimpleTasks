<?php

declare(strict_types=1);

namespace App\Filters;

use App\Filters\QueryFilter;

class GetEmployeesFilter extends QueryFilter
{

    public function name(string $value): void
    {
        $this->builder->where('name', $value);
    }

    public function email(string $value): void
    {
        $this->builder->where('email', $value);
    }
    public function employeeStatusId(int $value): void
    {
        $this->builder->where('employee_status_id', $value);
    }


}
