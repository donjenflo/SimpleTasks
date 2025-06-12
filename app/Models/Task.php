<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use  HasFactory, Filterable;

    protected $fillable = [
        'title',
        'description',
        'status_id',
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class,  'employee_task', 'task_id','employee_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
