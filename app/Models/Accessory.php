<?php

namespace App\Models;

use App\Traits\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory,ActivityLogger;
    protected $guarded = [];

    protected $fillable = [
        'code',
        'location_k',
        'location_c',
        'location',
        'material_norms',
        'image',
        'status'
    ];
       // $store = DB::connection('oracle')
        //         ->table('TAD_Z60M')
        //         ->where('場所C','like', '%0111%')
        //         ->where('品目K','like', '%7%')
        //         ->where('品目C','like', 'AVS5B%')->get();
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
}
