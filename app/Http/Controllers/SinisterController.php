<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Registration;
use App\Sinister;
use App\AonDecision;
use App\Client;
use App\Reparation;
use Carbon\Carbon;
use Auth;

class SinisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sinister.listing-sinister');
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
        $sinister = new Sinister;
        $registration = Registration::find($request->registration_id);

        // L'ajout du sinistre
        $sinister->data_flow = Carbon::now();
        $sinister->date_sinister = $request->date_sinister;
        $sinister->place_sinister = $request->place_sinister;
        $sinister->cause_sinister = $request->cause_sinister;
        $sinister->type_sinister = $request->type_sinister;
        $sinister->registration_id = $registration->id;

        // L'envoi d'une notofication à AON
        Auth::user()->notif('sinister');
        // --------        
        return response()->json($sinister->save());
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sinistre  $sinistre
     * @return \Illuminate\Http\Response
     */
    public function show(Sinistre $sinistre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sinistre  $sinistre
     * @return \Illuminate\Http\Response
     */
    public function edit(Sinistre $sinistre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sinistre  $sinistre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sinistre $sinistre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sinistre  $sinistre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sinistre $sinistre)
    {
        //
    }

    public function listingSinisters(Request $request)
    {
        $sinisters = Sinister::with(['registration.client', 'registration.smartphone.model.brand'])
        ->orderBy('data_flow', 'desc')
        ->get();
        if (Auth::user()->HasRole('agence')) {
            $sinisters = $sinisters->filter(function ($value, $key) {
                return $value->registration->agency_id = Auth::user()->agence_id;
            });
        }

        if($request->ajax()) {
            return Datatables::of($sinisters)
            ->addIndexColumn()
            ->addColumn('edit', function ($sinisters) {
                $link = '
                <button type="button" class="consult_sinister item btn btn-info" data-toggle="modal" data-id="'.$sinisters->id.'" data-target="#consult_sinister" data-backdrop="static" data-keyboard="false">
                    <i class="zmdi zmdi-eye"></i>
                </button>';
                if (Auth::user()->hasRole(['admin', 'agence']) && is_null($sinisters->aon_decision)) {
                    $link .= '<select name="aon_decision" class="aon_decision ml-1" data-id="'.$sinisters->id.'">
                                <option value="">Prennez une décision</option>
                                <option value="REP">Réparation</option>
                                <option value="CHG">Changement</option>
                                <option value="REJ">Rejet</option>
                                <option value="SAV">SAV STG</option>
                            </select>';
                }
                if(Auth::user()->hasRole(['admin', 'agence']) && $sinisters->status == 10) {
                    $link .= '<button type="button" class="confirmRep item btn btn-outline-success ml-1" data-toggle="modal" data-id="'.$sinisters->id.'" data-target="#confirm_reparation" data-backdrop="static" data-keyboard="false" title="Confirmer la réparation">
                    <i class="zmdi zmdi-check-circle-u"></i></button>';
                }
                return $link;
            })
            ->addColumn('aon_decision_date', function ($sinisters) {
                $aon_decision = AonDecision::where('sinister_id', $sinisters->id)->first();
                return $aon_decision ? $aon_decision->created_at->format('Y-m-d') : '---';
            })
            ->editColumn('status', function($sinisters){
                if ($sinisters->status == 0) {
                    return '<h4><span class="badge badge-secondary">En attante</span></h4>';
                }else if ($sinisters->status == 4) {
                    return '<h4><span class="badge badge-danger">Rejeté</span></h4>';
                }else if ($sinisters->status == 3) {
                    return '<h4><span class="badge badge-info">SAV</span></h4>';
                }else if ($sinisters->status == 11) {
                    return '<h4><span class="badge badge-success">Réparé</span></h4>';
                }else if ($sinisters->status == 10) {
                    return '<h4><span class="badge badge-light">En cours de réparation</span></h4>';
                }else {
                    return '<h4><span class="badge badge-success">Changé</span></h4>';
                }
            })
            ->editColumn('data_flow', function($sinisters){
                return $sinisters->data_flow->format('Y-m-d');
            })
            ->editColumn('date_sinister', function($sinisters){
                return $sinisters->date_sinister->format('Y-m-d');
            })
            ->rawColumns(['edit', 'aon_decision_date', 'status'])->make(true);
        }
        return view('sinister.listing-sinister');
    }

    public function addSinister()
    {
        return view('sinister.add-sinister');
    }

    public function getSinister($id)
    {
        $sinister = Sinister::where('id', $id)->with(['registration.smartphone.model.brand', 'registration.client'])->first();
        // dd($sinister);
        return response()->json($sinister);
    }

    public function setAonDecision($id, Request $request)
    {
        $sinister = Sinister::with('registration')->where('id', $id)->first();
        $sinister->aon_decision = $request->decision;
        // Enregistrer la decision AON dans la base
        $aon_decision = new AonDecision;
        $aon_decision->sinister_id = $sinister->id;
        $aon_decision->save();

        if ($request->decision == 'REP') {
            $sinister->status = 10;
        }elseif ($request->decision == 'CHG') {
            $request->session()->put('reg_id', $sinister->registration->id);
            $sinister->status = 2;
        }elseif ($request->decision == 'REJ') {
            $sinister->status = 4;
        }elseif ($request->decision == 'SAV') {
            $sinister->status = 3;
        }
        Auth::user()->aonDecisionNotif('aonDecision', $sinister->registration->agency_id);
        return response()->json($sinister->save());
    }

    public function setReparationStatus($id, Request $request) {
        $sinister = Sinister::find($id);
        $reparation = new Reparation;

        $reparation->data_flow = Carbon::now();
        $reparation->date_reparation = $request->date_reparation;
        $reparation->price_ttc_reparation = $request->price_ttc_reparation;
        $reparation->price_ttc_replacement = $request->price_ttc_replacement;
        $reparation->price_ttc_workforce = $request->price_ttc_workforce;
        $reparation->sinister_id = $sinister->id;
        
        $sinister->status = 11;

        return response()->json(($sinister->save() && $reparation->save()));
    }
}
