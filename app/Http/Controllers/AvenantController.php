<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Helpers\PDFClass;
use App\Helpers\ExcelDoc;
use Carbon\Carbon;
use App\Avenant;
use Excel;


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

    public function getAvenant($id)
    {
        $avenant = Avenant::where('id', $id)
        ->first();
        $avenant->registration->smartphone->model->brand;
        $avenant->registration->client;

        return response()->json($avenant);
    }

    public function listingAvenants(Request $request)
    {
        $avenants = Avenant::with('registration')
        ->orderBy('effective_date', 'desc')
        ->get();

        if($request->ajax()) {
            return Datatables::of($avenants)
            ->addIndexColumn()
            ->addColumn('edit', function ($avenants) {
                $link = '
                <button type="button" class="consult_avenant item btn btn-info" data-toggle="modal" data-id="'.$avenants->id.'" data-target="#consult_avenant">
                    <i class="zmdi zmdi-eye"></i>
                </button>';
                return $link;
            })
            ->addColumn('ref_reg', function ($avenants){
                return $avenants->registration->mandat_num;
            })
            
            ->editColumn('extension_added', function($avenants){
                return (($avenants->extension_added == 110) ? 'F2' : 'F3');
            })
            ->rawColumns(['edit', 'ref_reg'])
            ->make(true);
        }
        return view('avenants.listing-avenants', compact('registrations', 'avenants'));
    }

    public function export()
    {
        $avenants = Avenant::whereDate('created_at', 'like', '2018-06-25%')->get();
        
        if (!$avenants->isEmpty()) {
            $file_name = time().'_Liste_des_avenants.xlsx';
            $total_surprime = 0;
            foreach ($avenants as $avenant) {
                $avenant->registration->client;
                $avenant->registration->smartphone;
                $total_surprime += $avenant->add_premium;
            }
            // $excel = Excel::store(new ExcelDoc($registrations), $file_name);
            return Excel::download(new ExcelDoc($avenants, 'export.avenants', 'avenants', $total_surprime), $file_name);
            // return response()->json(['msg' => 'Votre export est effectué.', 'name' => $file_name, 'file' => public_path('\storage\export\\').$file_name, 'excel' => $excel]);
        }
    }
}
