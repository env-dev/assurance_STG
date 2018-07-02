<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function username()
    {
        return 'username';
    }

    public function authenticated()
    {
        if(Auth::user()->hasRole('admin') === true){
            return redirect('/');
		}else if(Auth::user()->hasRole('aon')=== true){
			return redirect('/listing-registrations');
		}else if(Auth::user()->hasRole('agence')=== true){
			//dd(Auth::user()->hasRole('agence'));
			 return redirect('/registration');
		}
		return abort(404, 'Unauthorized action.');
    }
    // protected function redirectPath()
    // {   
    //     if(Auth::user()->hasRole('admin'))
    //         return '/bbb';
    //     if(Auth::user()->hasRole('aon'))
    //         return '/listing-registrations';
    //     if(Auth::user()->hasRole('agency'))
    //         return '/registration';
    // }
}
