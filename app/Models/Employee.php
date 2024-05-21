<?php

namespace App\Models;

use App\Traits\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes, ActivityLogger;
    // protected $table = 'employees';
    protected $guarded = [];

    protected $seachable = [
        'id',
        'code',
        'first_name',
        'last_name',
        'identity_card',
        'native_land',
        'addresss',
        'birthday',
        'unit_id',
        'dept_id',
        'team_id',
        'process_id',
        'status',
        'marital',
        'worker',
        'positions',
        'begin_date_company',
        'end_date_company',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    // public function department()
    // {
    //     return $this->belongsTo(Department::class, 'name', '');
    // }
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

    public static function searchByAll(array $options = [])
    {
        $default = [
            'select'   => '*',
            'where'    => [],
            'order_by' => 'id DESC',
            'per_page' => 20,
        ];

        $options = array_merge($default, $options);
        extract($options);

        $model = self::select($options['select']);
        if ($options['where']) {
            $model = $model->where($options['where']);
        }

        return $model->orderByRaw($options['order_by'])->paginate($options['per_page']);
    }
    public function required()
    {
        return $this->belongsTo(Required::class, 'code_required', 'code');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'code', 'code');
    }
    public function employeeDepartment()
    {
        return $this->belongsTo(EmployeeDepartment::class, 'id', 'employee_id');
    }
    public static function findEmployeeById($id)
    {
        return $employee =  Employee::find($id);
    }
}
