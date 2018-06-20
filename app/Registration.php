<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Makeable\EloquentStatus\HasStatus;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        return $this->hasOne(Client::class, 'client_id');
    }
}
