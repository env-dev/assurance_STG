<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\City;
use App\User;
class Agence extends Model
{
    protected $guarded=[];

    public function City(){
        return $this->belongsTo(City::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
