<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Agence;
class City extends Model
{
    protected $guarded=[];

    public function Agence(){
        return $this->hasMany(Agence::class);
    }
}
