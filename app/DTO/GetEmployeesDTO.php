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
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
