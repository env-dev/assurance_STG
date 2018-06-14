<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Registration extends Model
{
    use SoftDeletes;
    
    protected $guarded=[];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'data_flow'];

    public function smartphone()
    {
        return $this->hasOne(Smartphone::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
