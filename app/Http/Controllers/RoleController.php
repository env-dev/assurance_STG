<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return response()->json(Role::all());
        }
        return view('roles_permissions_users.role',['roles'=>Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            //'display_name' => 'required',
            //'description' => 'required',
            //'permissions' => 'required',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;

        return response()->json($role->saveOrFail());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        if($role){
            if(request()->ajax()){
                return response()->json($role);
            }
            //return view('roles_permissions_users.role',['roles'=>Role::all()]);
        }
        return response()->json('The role you are looking for is not exists ', 412);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if($role){
            $this->validate($request, [
                'name' => 'required|unique:roles,name,'.$role->id,
                //'display_name' => 'required',
                //'description' => 'required',
                //'permissions' => 'required',
            ]);
    
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            return response()->json($role->saveOrFail());
        }
        return response()->json('The role you are trying to modify is not exists ', 412);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(Role::destroy($id));
    }
}
