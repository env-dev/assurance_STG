<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agence;
use App\City;
class AgenceController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return response()->json(Agence::select('id','full_name','name')->get());
        }
        return view('agency.index',['agences' => Agence::select('id','full_name','name')->get(),'cities'=>City::all()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agence = new Agence();
        $agence->name = $request->agence_name_add;
        $agence->full_name = $request->agence_fullname_add;
        $agence->reference = $request->agence_reference_add;
        $agence->address = $request->agence_address_add;
        $agence->email = $request->agence_email_add;
        $agence->phone = $request->agence_tel_add;
        $agence->city_id = $request->agence_city_add;

        return response()->json($agence->saveOrFail());
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(request()->ajax()){
            return response()->json(Agence::findOrFail($id));
        }
        return view('agency.index',['agences' => Agence::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agence $agence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agence $agence)
    {
        //
    }
}
