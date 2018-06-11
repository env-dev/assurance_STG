<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Client extends Model
{
    use SoftDeletes;

    protected $guarded=[];
    protected $dates = ['deleted_at'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
