<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Agence;
use App\Role;
class UserController extends Controller
{

    public function __construct(){
        $this->middleware(['auth','role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return User::with('agence')->get();
        if(request()->ajax()){
            return response()->json(User::all());
        }
        return view('auth.register',['users'=>User::all(),'agences'=>Agence::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|numeric',
        ]);

        $user =  User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'agence_id' => $request->agence ?? null
        ]);

        $user->attachRole($request['role']);

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
    
        // $user->agence_id = 2;
        // return response()->json($user);
        
        $user = User::find($id);
        $userRoles = $user->roles->pluck('id')->first();

        return response()->json(['user'=>$user,'role'=>$userRoles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user){
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,name,'.$user->id,
                'email' => 'string|email|max:255|unique:users,email,'.$user->id,
                'role' => 'required|numeric',
            ]);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->agence_id = $request->agence;
            $user->saveOrFail();
            
            // Remove All Roles 
            $user->detachRoles();
            $user->attachRole($request['role']);
    
            return response()->json($user);
        }
        return response()->json($user);
    }

    public function changePassword(Request $request,$id){
        $user = User::find($id);
        if($user){
            $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $user->password = Hash::make($request->password);
            $user->saveOrFail();
            return response()->json($user);
        }
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        // // Remove All Roles 
        $user->detachRoles();
        return response()->json($user->delete());

    }
}
