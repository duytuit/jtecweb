<?php

namespace App\Models;

use App\Traits\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes, ActivityLogger;
    protected $table = 'employees';
    protected $fillable = [
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
}
