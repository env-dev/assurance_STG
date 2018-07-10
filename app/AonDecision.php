<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

use App\Sinister;

class AonDecision extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $table = 'aon_decisions';

    public function sinister()
    {
        return $this->belongsTo(Sinister::class);
    }
}
