<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Registration extends Model
{
    use SoftDeletes;
    
    protected $guarded=[];
    protected $dates = ['deleted_at'];

    public function smartphone()
    {
        return $this->hasOne(Smartphone::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
