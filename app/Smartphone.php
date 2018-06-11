<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Smartphone extends Model
{
    use SoftDeletes;
    
    protected $guarded=[];
    protected $dates = ['deleted_at'];

    public function registration()
    {
        return $this->hasOne(Registration::class);
    }

    public function model()
    {
        return $this->belongsTo(BrandModel::class, 'brand_model_id');
    }
    public function trashed_model()
    {
        return $this->belongsTo(BrandModel::class, 'brand_model_id')->withTrashed();
    }
}
