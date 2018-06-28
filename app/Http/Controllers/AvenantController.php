<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avenant = Avenant::all();
        return view('inscription.avenants');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->extension_added)) {
            $avenant = new \App\Avenant;
            $avenant->mandat_num = str_random(10);
            $avenant->extension_added = $request->extension_added;
            $avenant->effective_date = \Carbon\Carbon::now();
            $avenant->add_premium = $request->add_premium;
            $avenant->registration_id = $request->registration_id;
    
            $avenant->save();
            return response()->json(['message' => "Félicitation, l'avenant est effectuer sur votre souscription.", 'status' => 200]);
        }
        return response()->json([['message' => "Erreur est survenu, veuillez selectionnez la guarantie.", 'status' => 500]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
