<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class NotificationController extends Controller
{
    // Read all unread notifications
    public function realAll(Request $request){
        if($request->ajax()){
            if(Auth::user()->hasRol('aon')){
                Auth::user()->unreadNotifications->markAsRead() ;
                return response()->json(['ok']);
            }
        }
    }

    public function readRegisterNotifcation(){
        if(Auth::user()->hasRole('aon')){
            Auth::user()->unreadNotifications->where('data.type','registration')->markAsRead();
        }
        return redirect('listing-registrations');
    }

    public function readSinisterNotifcation(){
        if(Auth::user()->hasRole('aon')){
            Auth::user()->unreadNotifications->where('data.type','sinister')->markAsRead();
        }
        return redirect('listing-sinisters');
    }
    public function readAonDecisionNotifcation(){
        if(Auth::user()->hasRole('agence')){
            Auth::user()->unreadNotifications->where('data.type','aonDecision')->markAsRead();
        }
        return redirect('listing-sinisters');
    }
}
