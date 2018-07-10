<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use App\City;
use App\User;
class Agence extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    protected $guarded=[];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function stockAgency(){
        return $this->belongsTo(StockAgency::class);
    }
}
