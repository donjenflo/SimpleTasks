<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'employee_status' => $this->whenLoaded('employee_status', function () {
                return new EmployeeStatusResource($this->employee_status);
                }),
            'roles'  => $this->whenLoaded('roles', function () {
                return RoleResource::collection($this->roles);
            })
        ];
    }
}
