<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Reparation extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function sinister() 
    {
        return $this->belongsTo(Sinister::class);
    }
}
