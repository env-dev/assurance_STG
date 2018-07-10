<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

use App\Smartphone;

class Sinister extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'date_sinister', 'data_flow'];

    // public function smartphone()
    // {
    //     return $this->belongsTo(Smartphone::class);
    // }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
