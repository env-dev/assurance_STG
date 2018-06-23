<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Makeable\EloquentStatus\HasStatus;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Carbon\Carbon;
class Registration extends Model
{
    use SoftDeletes, HasStatus;
    
    protected $guarded=[];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'data_flow'];

    public function smartphone()
    {
        return $this->belongsTo(Smartphone::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function isValidRegistration()
    {
        if($this->data_flow->diffInDays(Carbon::now()) <= 5)
        {
            return true;
        }
        return false;
    }

    public function avenant()
    {
        return $this->hasMany(Avenant::class);
    }
}
