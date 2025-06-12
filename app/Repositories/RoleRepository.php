<?php
declare(strict_types=1);


namespace App\Repositories;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function index(): ResourceCollection
    {
        return RoleResource::collection(Role::all());
    }
}
