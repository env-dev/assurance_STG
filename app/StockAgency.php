<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockAgency extends Model
{
    protected $guarded=[];

    public function smartphone(){
        return $this->hasMany(Smartphone::class);
    }

    public function agency(){
        return $this->hasMany(Agence::class);
    }
}
