<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    public const FOR_WORK_STATUS_ID = 1;
    public const IN_WORK_STATUS_ID = 2;
    public const COMPLETED_STATUS_ID = 3;
    public $timestamps = false;
    protected $fillable = ['title'];
}
