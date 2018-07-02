<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Helpers\RegistrationStatus;
use App\Registration;
use App\Agence;
use Notification;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function agence(){
        return $this->belongsTo(Agence::class);
    }

    public function countRegistration()
    {
        //if($this->hasRole('aon'))
            return Registration::status(new RegistrationStatus('newAdded'))->count();
    }

    public function notif($type){
        $users = $this::whereHas('roles', function($query) {
            $query->whereIn('name', ['admin','aon']);
        })->get();
       Notification::send($users, new \App\Notifications\NewRegistrationNotification($type));
    }


}
