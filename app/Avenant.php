<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Avenant extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    protected $guarded=[];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'effective_date'];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

}
