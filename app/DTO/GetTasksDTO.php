<?php
declare(strict_types=1);


namespace App\DTO;

use App\Filters\SearchSetInterface;
use DateTimeImmutable;
use Illuminate\Http\Request;

readonly class GetTasksDTO implements SearchSetInterface
{
    public function __construct(
        public ?string            $title,
        public ?string            $description,
        public ?int               $statusId,
        public ?int               $employeeId,
        public ?DateTimeImmutable $dateFrom,
        public ?DateTimeImmutable $dateTo,
        public ?string            $orderBy,
        public ?string            $orderDirection,
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->input('title'),
            description: $request->input('description'),
            statusId: (int)$request->input('status_id')?:null,
            employeeId: (int)$request->input('employee_id')?:null,
            dateFrom: $request->date('date_from')?->startOfDay()->toDateTimeImmutable(),
            dateTo: $request->date('date_to')?->endOfDay()->toDateTimeImmutable(),
            orderBy: $request->input('order_by'),
            orderDirection: $request->input('order_direction'),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status_id' => $this->statusId,
            'employee_id' => $this->employeeId,
            'date_from' => $this->dateFrom,
            'date_to' => $this->dateTo,
            'order_by' => $this->orderBy,
            'order_direction' => $this->orderDirection,

        ];
    }
}
