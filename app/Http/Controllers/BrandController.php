<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Brand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::select('id','name');
        return Datatables::of($brands)
        ->addIndexColumn()
        ->addColumn('actions', function ($brand) {
            return '
            <button type="button" class="btn btn-danger delete-marque" data-id="'.$brand->id.'" data-toggle="tooltip" data-placement="top" title="Supprimer"><i class="fa fa-times"></i></button>
            <button type="button" class="btn btn-info update-marque" data-id="'.$brand->id.'" data-toggle="tooltip" data-placement="top" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>
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
        $brand = new Brand();
        $brand->name = $request->name;
        $request->validate([
            'name' => 'required|unique:brands'
        ]);

        return response()->json($brand->saveOrFail());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Brand::findOrFail($id));
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
        $brand = Brand::findOrFail($id);
        if($brand){
            $request->validate([
                'name' => 'required|unique:brands'
            ]);
            $brand->name = $request->name;
            return response()->json($brand->saveOrFail());
        }

        return response()->json($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(Brand::findOrFail($id)->delete());
    }
}
