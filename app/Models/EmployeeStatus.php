<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    public const WORK_STATUS_ID = 1;
    public const VACATION_STATUS_ID = 2;
    public $timestamps = false;
    protected $fillable = [
        'title'
    ];
}
