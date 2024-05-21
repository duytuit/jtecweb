<?php

namespace App\Models;

use App\Traits\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, ActivityLogger;
    protected $table = 'departments';
    protected $fillable = [
        'id',
        'code',
        'name',
        'parent_id',
        'status',
        'created_by',
        'updated_by',
        'dateted_by',
        'deleted_at',
        'create_at',
        'updated_at',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'code', 'code');
    }
    public function employeeDepartmentByCount()
    {
        return $this->hasMany(EmployeeDepartment::class, 'department_id')->select('id')->count();
    }
    public static function findById($id)
    {
        return $department =  Department::find($id);
    }
}
