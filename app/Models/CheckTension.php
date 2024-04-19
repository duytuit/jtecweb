<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckTension extends Model
{
    use HasFactory;
    protected $table = 'checkTension';

    protected $fillable = [
        'name',
        'code',
        // 'create_date',
        'target125',
        'target2',
        'target55',
        'weight125',
        'weight2',
        'weight55',
        // 'machine',
        // 'checkresult',
    ];
}
