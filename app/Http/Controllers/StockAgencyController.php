<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SimpleXLSX;
use App\StockAgency;
use App\Registration;
use App\Smartphone;
use App\Agence;
use DB;
use File;

class StockAgencyController extends Controller
{
    public function __construct(){

    }
    
    public function __invoke(){
        return view('stock.index',['agencies' => Agence::select('id','reference','name')->get()]); //'smartphones' => Smartphone::select('id','imei')->get()
    }

    public function get_imei(Request $request){
        // Get all smartphones are not in the agency stock also bought one;
        $smartphones  =  DB::table('smartphones')
                ->where('imei', 'like' ,'%'.$request->q.'%')
                ->whereNotIn('smartphones.id', Registration::select('smartphone_id')->get()->toArray())
                ->select('id','imei');
                
                if($request->action == 'post')
                    $smartphones->whereNotIn('smartphones.id', StockAgency::select('smartphone_id')->get()->toArray());
                else{
                    $smartphones->join('stock_agencies', 'stock_agencies.smartphone_id', 'smartphones.id');//StockAgency::select('smartphone_id')->get()->toArray());
                    $smartphones->where('agency_id', $request->agence);
                    $smartphones->whereIn('smartphones.id', StockAgency::select('smartphone_id')->get()->toArray());
                } 
        return response()->json($smartphones->limit(10)->get());
    }

    public function operation(Request $request){

        if ($request->isMethod('delete')) {
            return $this->delete($request);
        }

        if ($request->isMethod('post')) {
            if($request->type=="file_delete")
                return $this->delete($request);
            return $this->store($request);
        }
    }

    public function store(Request $request){
        $agence = $request->agence;
        $action = $request->action;
        $errors = [];

        if ($action == "classic1"){
            $list_imei = $request->imei_modal;
            foreach($list_imei as $smartphoneID){
                $stock_agency = new StockAgency();
                $stock_agency->smartphone_id = $smartphoneID;
                $stock_agency->agency_id = $agence;
                $stock_agency->save();
            }
            return response()->json([true],200);
        }
        else if ($action == "classic2"){
            $list_imei = explode("\n",$request->imei_list_modal);
            foreach($list_imei as $imei){
                $check = $this->checkExists($imei);
                if($check[0]){
                    $stock_agency = new StockAgency();
                    $stock_agency->smartphone_id = $check[1];
                    $stock_agency->agency_id = $agence;
                    $stock_agency->save();
                }else{
                    $errors[] = $check[1];
                }
            }
            if($errors)
                return response()->json([false,$errors],412);

            return response()->json([true],200);
        }
        else if ($action == "bulk"){
            if($request->hasFile('smart_file')){
                $file = $request->file('smart_file');
                $extension = File::extension($file->getClientOriginalName());
                if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                    $path = $file->getRealPath();
                    $xlsx = new SimpleXLSX($path);
                    if($xlsx->success()) {
                        foreach ( array_slice($xlsx->rows(),1) as $ex_model) {
                            $imei = $ex_model[2]; //  IMEI
                            $check = $this->checkExists($imei);
                            if($check[0]){
                                $insert[] = [
                                'smartphone_id' => $check[1], //Smartphone::select('id')->where('imei',$imei)->first(),
                                'agency_id' => $agence,
                                'created_at' => now(),
                                'updated_at' => now(),
                                ];
                            }else{
                                $errors[] = $check[1];
                            }
                        }
                        if(!empty($insert)){
                            if(StockAgency::insert($insert))
                                return response()->json(["The data is inserted successfully",$errors],200);  
                            else
                                return response()->json(["An error occured while inserting the data",$errors],412);  
                        }else{
                            return response()->json(["An error occured while inserting the data",$errors],412);  
                        }
                    } else {
                        return response()->json($xlsx->error(),412);
                    }
                }
                return response()->json("File is a {$extension} file.!! Please upload a valid xls/csv file..!!",412);
            }
            return response()->json("No File is Uploaded",412);
        }
        else
            return 'ababab';
    }

    public function delete(Request $request){
        $agence = $request->agence;
        $action = $request->action;
        $errors = [];
        
        if ($action == "classic1"){
            return response()->json(DB::table('stock_agencies')->where('agency_id',$agence)->whereIn('smartphone_id', $request->imei_modal)->delete());
        }
        else if ($action == "classic2"){
            $list_imei = explode("\n",$request->imei_list_modal);
            $list_imei_ids = [];
            foreach($list_imei as $imei){
                $s = Smartphone::select('id')->where('imei',$ex_model[2])->first();
                    if($s)
                        $list_imei_ids[] = $s->id;
            }
            return response()->json(DB::table('stock_agencies')->where('agency_id',$agence)->whereIn('smartphone_id', $list_imei_ids)->delete());
        }
        else if ($action == "bulk"){
            if($request->hasFile('smart_file')){
                $file = $request->file('smart_file');
                $extension = File::extension($file->getClientOriginalName());
                if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                    $path = $file->getRealPath();
                    $xlsx = new SimpleXLSX($path);
                    if($xlsx->success()) {
                        $list_imei_ids = [];
                        foreach ( array_slice($xlsx->rows(),1) as $ex_model) {
                            $s = Smartphone::select('id')->where('imei',$ex_model[2])->first();
                            if($s)
                                $list_imei_ids[] = $s->id;
                        }
                        return response()->json([DB::table('stock_agencies')->where('agency_id',$agence)->whereIn('smartphone_id', $list_imei_ids)->delete()]);
                        //return response()->json(['ok',DB::table('stock_agencies')->where('agency_id',$agence)->whereIn('smartphone_id', $list_imei_ids)->delete()]);
                    } else {
                        return response()->json($xlsx->error());
                    }
                }
                return response()->json("File is a {$extension} file.!! Please upload a valid xls/csv file..!!");
            }
            return response()->json("No File is Uploaded");
        }
        else
            return null;
    }

    public function getAgencyInfo($id){
        return DB::table('agences')
                ->join('stock_agencies','agences.id','stock_agencies.agency_id')        
                ->join('smartphones','smartphones.id','stock_agencies.smartphone_id')        
                ->where('agences.id',$id)
                ->select(DB::raw('smartphones.'))
                ->count();
    }

    private function checkExists($imei){
        $sp = Smartphone::where('imei',$imei)->first();
        if($sp){
            if(StockAgency::where('smartphone_id',$sp->id)->first() || Registration::where('smartphone_id',$sp->id)->first()){
                return array(false,"<b>{$imei}</b> is already out of stock or boughten"); 
            }
        }else{
            return array(false,"<b>{$imei}</b> is not exists in our records");
        }
        return array(true ,$sp->id);
    }
}