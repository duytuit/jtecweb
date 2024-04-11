<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    protected $seachable = ['title', 'status', 'pub_profile_id', 'bdc_handbook_category_id', 'bdc_handbook_type_id','id','department_id','order','feature','bdc_business_partners_id','url_video'];

    // public function handbook_department()
    // {
    //     return $this->belongsTo(Department::class, 'department_id');
    // }
    // public function businesspartners()
    // {
    //     return $this->belongsTo(BusinessPartners::class, 'bdc_business_partners_id');
    // } 

    public function scopeFilter($query, $input)
    {
        foreach ($this->seachable as $value) {
            if (isset($input[$value])) {
                $query->where($value, $input[$value]);
            }
        }
        // return $this->model
        //   ->with('handbook_category', 'pub_profile')
        //   ->where('bdc_building_id', $active_building)
        //   ->filter($keyword)
        //   ->orderBy('updated_at', 'DESC')
        //   ->paginate($per_page);
        
        if (isset($input['handbook_keyword'])) {
            $search = $input['handbook_keyword'];
            $query->where(function ($q) use ($search) {
                foreach ($this->seachable as $value) {
                    $q->orWhere($value, 'LIKE', '%' . $search . '%');
                }
            });
        }
        return $query;
    }
}
