<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use App\Brand;
use App\Smartphone;
class BrandModel extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    protected $guarded=[];
    protected $cascadeDeletes = ['smartphones'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function smartphones()
    {
        return $this->hasMany(Smartphone::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    public function trashed_brand()
    {
        return $this->belongsTo(Brand::class)->withTrashed();
    }
}
