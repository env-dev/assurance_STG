<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Client extends Model
{
    use SoftDeletes;

    protected $guarded=[];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'birth_date'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function fullName() {
        return $this->first_name . ' ' . $this->last_name;
    }
}
