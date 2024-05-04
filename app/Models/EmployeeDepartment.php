<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ActivityLogger;

class EmployeeDepartment extends Model
{
    use HasFactory, SoftDeletes, ActivityLogger;
    protected $fillable = [
        'id',
        'employee_id',
        'department_id',
        'positions',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
