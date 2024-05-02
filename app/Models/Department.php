<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [
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
}
