<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Required extends Model
{
    use HasFactory;
    protected $table = 'requireds';

    protected $fillable = [
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
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'code', 'code');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'code_required', 'code');
    }
}
