<?php
declare(strict_types=1);


namespace App\DTO;

use App\Filters\SearchSetInterface;
use Illuminate\Http\Request;

readonly class TaskDTO implements SearchSetInterface
{
    public function __construct(
        public string $title,
        public string $description,
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->input('title'),
            description: $request->input('description')
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
