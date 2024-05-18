<?php

namespace App\Models;

use App\Traits\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Required extends Model
{
    use HasFactory, ActivityLogger;
    protected $table = 'requireds';

    protected $seachable  = [
        'id',
        'code_required',
        'code',
        'quantity',
        'unit_price',
        'content',
        'size',
        'image',
        'required_department_id',
        'receiving_department_ids',
        'status',
        'from_type',
        'date_completed',
        'order',
        'created_by',
        'completed_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'created_at',
        'updated_at',
        'content_form',
    ];

    public function scopeFilter($query, $input)
    {
        foreach ($this->seachable as $value) {
            if (isset($input[$value])) {
                $query->where($value, $input[$value]);
            }
        }
        if (isset($input['keyword'])) {
            $search = $input['keyword'];
            $query->where(function ($q) use ($search) {
                foreach ($this->seachable as $value) {
                    $q->orWhere($value, 'LIKE', '%' . $search . '%');
                }
            });
        }
        return $query;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'created_by', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'code_required', 'code');
    }
    public function employeeDepartment()
    {
        return $this->belongsTo(EmployeeDepartment::class, 'required_department_id', 'department_id');
    }
    public function signatureSubmission()
    {
        return $this->hasMany(SignatureSubmission::class, 'required_id');
    }
}
