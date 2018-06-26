<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Smartphone;
use Yajra\Datatables\Datatables;
use Excel;
use File;
use DB;
use App\Helpers\SimpleXLSX;
use App\BrandModel;
class SmartphoneController extends Controller
{

    public function __construct(){
       
    }
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
        $phone->imei2 = $request->imei2;
        $phone->brand_model_id = $request->brand_model_id;

        $request->validate([
            'imei' => 'required|unique:smartphones,imei',
            'imei2' => 'required|unique:smartphones,imei2',
            'brand_model_id' => 'required|numeric'
        ]);
        return response()->json($phone->saveOrFail());
    }

    

    /**
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
            $phone->imei = $request->imei;
            $phone->imei2 = $request->imei2;
            $phone->brand_model_id = $request->brand_model_id;
            $request->validate([
                'imei' => 'required|unique:smartphones,imei,'.$phone->id,
                'imei2' => 'required|unique:smartphones,imei2,'.$phone->id,
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

    public function import(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'smart_file'      => 'required'
        ));
        
        if($request->hasFile('smart_file')){
            $file = $request->file('smart_file');
            $extension = File::extension($file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $file->getRealPath();
                $xlsx = new SimpleXLSX($path);

                if ($xlsx->success()) {
                    foreach ( array_slice($xlsx->rows(),1) as $ex_model) {
                        $modelName  = $ex_model[0]; // Model's Name
                        $modelImei1 = $ex_model[2]; // Model's IMEI
                        $modelImei2 = $ex_model[3]; // Model's IMEI2
                        $modelSN    = $ex_model[4]; // Model's SN
                        $modelWifi  = $ex_model[5]; // Model's Wifi

                        $model = BrandModel::where('name',$modelName)->first();
                        if($model){
                            $insert[] = [
                            'brand_model_id' => $model->id,
                            'imei' => $modelImei1,
                            'imei2' => $modelImei2,
                            'sn' => $modelSN,
                            'wifi' => $modelWifi,
                            'created_at' => now(),
                            'updated_at' => now(),
                            ];
                        }
                    }
                    if(!empty($insert)){
                        $insertData = Smartphone::insert($insert);
                        if($insertData)
                            // return redirect()->back()->with('feedback', "The data is inserted successfully");  
                            return response()->json("The data is inserted successfully");  
                        else
                            // return redirect()->back()->with('feedback', "An error occured while inserting the data");  
                            return response()->json("An error occured while inserting the data");  
                    }
                } else {
                    // return redirect()->back()->with('feedback', $xlsx->error());
                    return response()->json($xlsx->error());
                }
            }
            // return redirect()->back()->with('feedback', "File is a {$extension} file.!! Please upload a valid xls/csv file..!!");
            return response()->json("File is a {$extension} file.!! Please upload a valid xls/csv file..!!");
        }
        // return redirect()->back()->with('feedback', "No File is uploaded");
        return response()->json("No File is uploaded");
    }
}
