<?php

namespace App\Models;

use App\Traits\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckDevice extends Model
{
    use HasFactory,ActivityLogger;
    protected $guarded = [];

}
