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
            return response()->json(Agence::with('city')->where('id',$id)->first());
        }
        return view('agency.index',['agence' => Agence::with('city')->where('id',$id)->first()]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agence = Agence::find($id);

        if($agence){
            $agence->name = $request->agence_name_modal;
            $agence->full_name = $request->agence_fullname_modal;
            $agence->reference = $request->agence_reference_modal;
            $agence->address = $request->agence_address_modal;
            $agence->email = $request->agence_email_modal;
            $agence->phone = $request->agence_tel_modal;
            $agence->city_id = $request->agence_city_modal;
            
            return response()->json($agence->saveOrFail());
        }
        return response()->json(['error'=> 'Agency not Found']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(Agence::destroy($id));
    }

    public function getAgencies()
    {
        $agencies = Agence::all();
        return response()->json($agencies);
    }
}
