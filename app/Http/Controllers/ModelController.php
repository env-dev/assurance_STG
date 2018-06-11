<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\BrandModel;
use DB;
class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = BrandModel::with('brand')->get();

        return Datatables::of($models)
        ->addIndexColumn()
        ->addColumn('actions', function ($model) {
            return '
            <button type="button" class="btn btn-danger delete-model" data-id="'.$model->id.'" title="Supprimer"><i class="fa fa-times"></i></button>
            <button type="button" class="btn btn-info update-model" data-id="'.$model->id.'" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>
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
        $model = new BrandModel();
        $model->brand_id = $request->marque;
        $model->name = $request->name;
        $model->price_ttc = $request->price_ttc;
        $request->validate([
            'name' => 'required|unique:brand_models',
            'price_ttc' => 'required|numeric'
        ]);
        return response()->json($model->saveOrFail());
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(BrandModel::findOrFail($id));
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
        $model = BrandModel::findOrFail($id);
        
        if($model){
            $model->brand_id = $request->marque;
            $unique = ($model->name != $request->name) ? '|unique:brand_models' : '';
            $model->name = $request->name;
            $model->price_ttc = $request->price_ttc;
            $request->validate([
                'name' => 'required'.$unique,
                'price_ttc' => 'required|numeric'
            ]);
            return response()->json($model->saveOrFail());
        }
        return response()->json($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(BrandModel::findOrFail($id)->delete());
    }
}
