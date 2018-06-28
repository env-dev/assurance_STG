<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use App\Smartphone;
use DB;
class DashboardController extends Controller
{

    public function __invoke()
    {
        return view('dashboard');
        return DB::table('brand_models')
        ->join('smartphones', "smartphones.brand_model_id", "=" , "brand_models.id")
        ->join('registrations', "registrations.smartphone_id" , "=", "smartphones.id")
        ->select(DB::raw('count(brand_models.name) as total, brand_models.name'))
        ->groupBy('brand_models.name')
        ->get();
    }

    public function statistics(){
        $registrationPerWeek = Registration::select(DB::raw('DATE(created_at) as date,COUNT(*) as total'))
                            ->groupBy('date')
                            ->orderBy('date')
                            ->take('7')
                            ->get();
        
        $totalSmartphones = Smartphone::count();
        
        $totalEarningPerDay = DB::table('registrations')
        ->join('smartphones', "registrations.smartphone_id" , "=", "smartphones.id")
        ->join('brand_models', "smartphones.brand_model_id", "=" , "brand_models.id")
        ->select(DB::raw('sum(price_ttc) as total, DAY(registrations.created_at) as day,MONTH(registrations.created_at) as month'))
        ->groupBy('day','month')
        ->get();

        $smartPhoneByModel = DB::table('brand_models')
                        ->join('smartphones', "smartphones.brand_model_id", "=" , "brand_models.id")
                        ->join('registrations', "registrations.smartphone_id" , "=", "smartphones.id")
                        ->select(DB::raw('count(brand_models.name) as total, brand_models.name names'))
                        ->groupBy('brand_models.name')
                        ->get();

        return response()->json([
            'registrationPerDay' => $registrationPerWeek,
            'totalSmartphones'   => $totalSmartphones,
            'totalEarningPerDay' => $totalEarningPerDay,
            'smartPhoneByModel' => $smartPhoneByModel
        ]);

    }
}
