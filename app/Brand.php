<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Brand extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    protected $guarded=[];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $cascadeDeletes = ['brand_models'];

    public function brandModels()
    {
        return $this->hasMany(BrandModel::class);
    }
}
