<?php

declare(strict_types=1);

namespace App\Filters;

use App\Filters\QueryFilter;

class GetTasksFilter extends QueryFilter
{

    public function title(string $value): void
    {
        $this->builder->where('title', 'ILIKE','%' . $value . '%');
    }

    public function description(string $value): void
    {
        $this->builder->where('description', 'ILIKE','%' . $value . '%');
    }

    public function statusId(int $value): void
    {
        $this->builder->where('status_id', $value);

    }

    public function employeeId(int $value): void
    {
        $this->builder->whereHas('employees', function ($query) use ($value) {
            $query->where('users.id', $value);
        });
    }

    public function dateFrom(\DateTimeImmutable $value): void
    {
        $this->builder->where('created_at', '>=', $value->format('Y-m-d H:i:s'));
    }

    public function dateTo(\DateTimeImmutable $value): void
    {
        $this->builder->where('created_at', '<=', $value->format('Y-m-d H:i:s'));
    }


}
