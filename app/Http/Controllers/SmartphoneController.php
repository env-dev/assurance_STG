<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Smartphone;
use App\BrandModel;
use App\StockAgency;
use App\Agence;
use App\Client;
use App\Registration;
use App\Helpers\SimpleXLSX;
use File;
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
        return Datatables::of(Smartphone::query()->with('model:id,name'))
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
        $phone->sn = $request->sn;
        $phone->wifi = $request->wifi;
        $phone->brand_model_id = $request->brand_model_id;

        $request->validate([
            'imei' => 'required|unique:smartphones,imei',
            'imei2' => 'required|unique:smartphones,imei2',
            'sn' => 'unique:smartphones,sn',
            'wifi' => 'unique:smartphones,wifi',
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
            $phone->sn = $request->sn;
            $phone->wifi = $request->wifi;
            $phone->brand_model_id = $request->brand_model_id;
            $request->validate([
                'imei' => 'required|unique:smartphones,imei,'.$phone->id,
                'imei2' => 'required|unique:smartphones,imei2,'.$phone->id,
                'sn' => 'unique:smartphones,sn,'.$phone->id,
                'wifi' => 'unique:smartphones,wifi,'.$phone->id,
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
        if($request->ajax()){
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


    public function phoneStatus(Request $request){
        if($request->ajax()){
            $phones = Smartphone::with('model')->get();

            return Datatables::of($phones)
            ->addColumn('actions', function ($phone) {
                if($phone->status == 2)
                    return '<button class="btn btn-outline-info agence" data-id="'.$phone->id.'"  title="Info">&nbsp;<i class="fas fa-info"></i>&nbsp;</button>';
                elseif($phone->status == 3)
                    return '<button class="btn btn-outline-success client" data-id="'.$phone->id.'"  title="Info">&nbsp;<i class="fas fa-info"></i>&nbsp;</button>';
                else
                    return 'No Infos';
            })
            ->editColumn('status', function($phone){
                if($phone->status == 1)
                    return '<span class="badge badge-pill badge-dark">STG Stock</span>';
                elseif($phone->status == 2)
                    return '<span class="badge badge-pill badge-info">Agency Stock</span>';
                else
                    return '<span class="badge badge-pill badge-success">Selled</span>';
            })
            ->rawColumns(['actions','status'])
            ->make(true); 
        }
        return view('stock.phone_status',['smartphones'=> Smartphone::with('model')->get()]);
    }

    public function phoneStatusInfo(Request $request){

        $lookingFor = $request->lookingFor;
        $idSmartphone = $request->idSmartphone;

        if($lookingFor == 'agence'){
            $agenceID = StockAgency::where('smartphone_id',$idSmartphone)->first()->agency_id;
            return response()->json(Agence::with('city')->where('id',$agenceID)->first());
        }
        
        if($lookingFor == 'client'){
            $registrationInfos = Registration::where('smartphone_id',$idSmartphone)->select('agency_id','client_id')->first();
            $client = Client::findOrFail($registrationInfos->client_id);
            $agence = Agence::with('city')->where('id',$registrationInfos->agency_id)->first();
            return response()->json(["agence"=>$agence,"client" => $client]);
        }

        return null;
    }

    public function checkImeis(Request $request){
        if($request->ajax()){
            $imei1 = $request->imei1;
            $imei2 = $request->imei2;
            $smartphone = Smartphone::where('imei',$imei1)->where('imei2',$imei2);
            if($smartphone->count() > 0)
                return response()->json(['status'=>true,'registred'=>$smartphone->has('registration')->count()]);
            
            return response()->json(['status'=>false,'msg'=>'IMEI1 OR IMEI2 is incorrect']);
        }
        // if($request->ajax()){
        //     $imei1 = $request->imei1;
        //     $imei2 = $request->imei2;
        //     $dc = $request->dc ?? null;
        //     $smartphone = Smartphone::where('imei',$imei1)->where('imei2',$imei2);
        //     if(!is_null($dc)){
        //         $smartphone = $smartphone->where('promo_code',$dc)->where('promo_code_status',0);
        //         if($smartphone->count() > 0)
        //             return response()->json(['status'=>true,
        //                                         'registred'=>$smartphone->has('registration')->count(),
        //                                         'promo'=>true,
        //                                         'details'=>$smartphone->with('registration.client')->first()
        //                                     ]);
    
        //         return response()->json(['status'=>false,'msg'=>'information is incorrect, or client alreay benefit from this promo']);
        //     }else{
        //         if($smartphone->count() > 0)
        //             return response()->json(['status'=>true,'registred'=>$smartphone->has('registration')->count(),'promo'=>false]);

        //         return response()->json(['status'=>false,'msg'=>'Your information is incorrect, please verify again']);
        //     }
        // }
    }

    public function info(Request $request){
		$imei = $request->imei;
		
		$smartphone = Smartphone::where('imei',$imei);
		
		// if($request->verify == true){
			// $exists = ($smartphone->count() > 0);
			// return response()->json(['status'=>200,'data' => $exists],200);	
		// }
		
		if($smartphone->count() > 0)
			if($smartphone->has('registration')->count()>0)				
				return response()->json(['status'=>200,'data' => $smartphone->with(['model:id,name','registration.client'])->get()],200);	
			else
				return response()->json(['status'=>404,'data'=>'This Smartphone is not registered yet'], 200);
			
		return response()->json(['status'=>404,'data'=>'IMEI is incorrect or not exists, please verify it again'], 200);
		
	}
}
