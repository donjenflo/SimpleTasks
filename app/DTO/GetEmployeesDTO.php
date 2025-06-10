<?php
declare(strict_types=1);


namespace App\DTO;

use App\Filters\SearchSetInterface;
use Illuminate\Http\Request;

readonly class GetEmployeesDTO implements SearchSetInterface
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?int    $employeeStatusId,
        public ?string $orderBy,
        public ?string $orderDirection,
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            employeeStatusId: $request->input('employee_status_id'),
            orderBy: $request->input('order_by'),
            orderDirection: $request->input('order_direction'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'employee_status_id' => $this->employeeStatusId,
        ];
    }
}
