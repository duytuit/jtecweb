<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignatureSubmissions extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'required_id',
        'department_id',
        'content',
        'positions',
        'approve_id',
        'sign_instead',
        'status',
        'deleted_at',
        'created_at',
        'updated_at',

    ];
}
