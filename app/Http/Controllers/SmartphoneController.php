<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Smartphone;
use Yajra\Datatables\Datatables;
class SmartphoneController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phones = Smartphone::with('model.brand')->get();

        return Datatables::of($phones)
        ->addIndexColumn()
        ->addColumn('actions', function ($phone) {
            return '
            <button type="button" class="btn btn-danger delete-appareil" data-id="'.$phone->id.'" title="Supprimer"><i class="fa fa-times"></i></button>
            <button type="button" class="btn btn-info update-appareil" data-id="'.$phone->id.'" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>
            ';
        })
        ->rawColumns(['actions'])
        ->make(true); 
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phone = new Smartphone();
        $phone->imei = $request->imei;
        $phone->brand_model_id = $request->brand_model_id;

        $request->validate([
            'imei' => 'required|unique:smartphones',
            'brand_model_id' => 'required|numeric'
        ]);
        return response()->json($phone->saveOrFail());
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Smartphone::findOrFail($id));
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
        $phone = Smartphone::findOrFail($id);
       

        if($phone){
            $unique = ($phone->imei != $request->imei) ? '|unique:smartphones' : '';
            $phone->imei = $request->imei;
            $phone->brand_model_id = $request->brand_model_id;
            $request->validate([
                'imei' => 'required'.$unique,
                'brand_model_id' => 'required|numeric'
            ]);
            return response()->json($phone->saveOrFail());
        }
        return response()->json($phone);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(Smartphone::findOrFail($id)->delete());
    }
}
