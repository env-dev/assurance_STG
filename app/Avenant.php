<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Avenant extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    protected $guarded=[];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

}
