<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Helpers\PDFClass;
use App\Helpers\ExcelDoc;
use App\Helpers\RegistrationStatus;
use Yajra\Datatables\Datatables;
use App\Registration;
use App\Smartphone;
use App\Client;
use App\Agence;
use App\Avenant;
use App\Sinister;
use Carbon\Carbon;
use Auth;
use Excel;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->has('reg_id')) {
            $registration = Registration::find($request->session()->get('reg_id'));
            $avenant = Avenant::where('registration_id', $registration->id)->first();
            if ($avenant) {
                return view('inscription.main')->with('guarantee', $avenant->extension_added);
            }
            return view('inscription.main')->with('guarantee', $registration->guarantee);
        }
        return view('inscription.main');
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
        $rules = [
            'last_name'  => 'required|min:3',
            'first_name'  => 'required|min:3',
            'birth_date'  => 'required',
            'city' => 'required',
            'agency' => 'required|integer',
            'nature' => 'required',
            'num_id' => 'required',
            'imei' => 'required',
        ];

        $this->validate($request,$rules);

        $client = new Client;

        $client->first_name = request('first_name');
        $client->last_name = request('last_name');
        $client->tel = request('tel');
        $client->email = request('email');
        $client->city = request('city');
        $client->address = request('address');
        $client->nature = request('nature');
        $client->type_id = request('type_id');
        $client->num_id = request('num_id');
        $client->birth_date = request('birth_date');

        $client->save();

        $smartphone = Smartphone::where('imei', request('imei'))->first();
        $smartphone->status = 3;
        $price_smartphone = $smartphone->model->price_ttc;
        $smartphone->model->brand;

        $smartphone->save();
        
        $agency = Agence::find(request('agency'))->first();
        $registration = new Registration;

        $registration->mandat_num = str_random(10);
        // $registration->data_flow = request('date_flow_data');
        $registration->data_flow = \Carbon\Carbon::now();
        $registration->guarantee = request('guarantee');
        $total_ttc = $price_smartphone;
        if(request('guarantee') == '110'){
            $total_ttc = $price_smartphone + ($price_smartphone * 10)/100;
        }
        // }else if(request('guarantee') == '111'){
        //     $total_ttc = $price_smartphone + ($price_smartphone * 20)/100;
        // }
        $registration->total_ttc = $total_ttc;
        $registration->smartphone_id = $smartphone->id;
        $registration->client_id = $client->id;
        $registration->agency_id = Auth::user()->agence->id ?? $agency->id;

        $registration->save();

        Session::flush();
        
        $pdf = new PDFClass;
        // if (request('guarantee') == '110' || request('guarantee') == '111') {
        if (request('guarantee') == '110') {
            Auth::user()->notif('registration');
            return $pdf->downloadPDF('pdfs.registration', $client, $registration, $smartphone, $agency);
        }
        
        Auth::user()->notif('registration');
        return $pdf->downloadPDF('pdfs.AAM_F1', $client, $registration, $smartphone, $agency);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registration = Registration::with('smartphone.model.brand')
        ->where('id', $id)
        ->first();
        if($registration->new == 1 && Auth::User()->hasRole('aon'))
        {
            $registration->new = 0;
            $registration->save();
        }
        return view('inscription.edit-registration')->with(['registration' => $registration]);
    }

    public function getRegistration($id)
    {
        $registration = Registration::with(['smartphone.model.brand', 'client'])
        ->with(['avenant' => function($query) use($id) {
            $query->where('registration_id', $id)->latest('created_at')->first();
        }])
        ->where('id', $id)
        ->first();
        $agency = Agence::find($registration->agency_id);
        return response()->json(compact('registration', 'agency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registration = Registration::with(['smartphone.model.brand', 'client'])
        ->where('id', $id)
        ->first();

        $agency = Agence::find($registration->agency_id);
        $pdf = new PDFClass;
        if ($registration->guarantee == 100) { //If guarantee is F1
            $avenant = Avenant::where('registration_id', $registration->id)->latest()->first(); //Get last avenant added
            if ($avenant) {
                $registration->guarantee = $avenant->extension_added; //Change guarantee by the avenant guarantee to be used in view
                return $pdf->downloadPDF('pdfs.registration', $registration->client, $registration, $registration->smartphone, $agency); //Download the suited pdf
            }
            return $pdf->downloadPDF('pdfs.AAM_F1', $registration->client, $registration, $registration->smartphone, $agency);
        }else if($registration->guarantee == 110) { //If guarantee is F2
            $avenant = Avenant::where('registration_id', $registration->id)->latest()->first(); //Get last avenant added
            if ($avenant) {
                $registration->guarantee = $avenant->extension_added; //Change guarantee by the avenant guarantee to be used in view
                return $pdf->downloadPDF('pdfs.registration', $registration->client, $registration, $registration->smartphone, $agency); //Download the suited pdf
            }
            return $pdf->downloadPDF('pdfs.registration', $registration->client, $registration, $registration->smartphone, $agency);
        }else {
            return $pdf->downloadPDF('pdfs.registration', $registration->client, $registration, $registration->smartphone, $agency);
        }
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

    public function listingRegistrations(Request $request)
    {
        $registrations = Registration::with(['smartphone.model.brand', 'client'])
        ->orderBy('data_flow', 'desc')
        ->get();
        if (Auth::user()->HasRole('agence')) {
                $registrations = $registrations->filter(function ($value, $key) {
                    return $value->agency_id = Auth::user()->agence_id;
                });
        }
        $new_registrations = Registration::status(new RegistrationStatus('newAdded'))->count();
        // dd(Datatables::of($registrations)->make(true));
        if($request->ajax()) {
            return Datatables::of($registrations)
            ->addIndexColumn()
            ->addColumn('edit', function ($registrations) {
                $avenant = Avenant::where('registration_id', $registrations->id)->latest()->first();
                $sinister = Sinister::where('registration_id', $registrations->id)->latest()->first();
                
                $link = '
                <button type="button" class="consult_reg item btn btn-info" data-toggle="modal" data-id="'.$registrations->id.'" data-target="#consult_reg" data-backdrop="static" data-keyboard="false" title="Consulter">
                    <i class="zmdi zmdi-eye"></i>
                </button>';

                // if (Auth::user()->HasRole(['admin', 'agence']) && (!$sinister || $sinister->status == 11)) {
                if (Auth::user()->HasRole(['admin', 'agence'])) {
                    if ($sinister) {
                        if ($sinister->status != 0) {
                            $link .= '
                                    <button type="button" class="add_sinister item btn btn-outline-warning" data-toggle="modal" data-id="'.$registrations->id.'" data-target="#add_sinister" data-backdrop="static" data-keyboard="false" title="Déclarer un sinistre">
                                    <i class="fas fa-exclamation-circle"></i>
                                    </button>';
                        }
                    }else {
                        $link .= '
                        <button type="button" class="add_sinister item btn btn-outline-warning" data-toggle="modal" data-id="'.$registrations->id.'" data-target="#add_sinister" data-backdrop="static" data-keyboard="false" title="Déclarer un sinistre">
                        <i class="fas fa-exclamation-circle"></i>
                        </button>';
                    }
                }

                if (Auth::user()->HasRole('agence') && $registrations->isValidRegistration() && ($registrations->guarantee < 110)) {
                    if (!$avenant) {
                        $link .= 
                            '&nbsp;<button type="button" class="item btn btn-success addAvenant" data-toggle="modal" data-id="'.$registrations->id.'" data-target="#addAvenant" title="Ajouter un avenant">
                                <i class="zmdi zmdi-plus-circle"></i>
                            </button>';
                        // if ($avenant->extension_added < 111) {
                        //     $link .= 
                        //     '&nbsp;<button type="button" class="item btn btn-success addAvenant" data-toggle="modal" data-id="'.$registrations->id.'" data-target="#addAvenant" title="Ajouter un avenant">
                        //         <i class="zmdi zmdi-plus-circle"></i>
                        //     </button>';
                        // }
                    }
                    // else {
                    //     $link .= 
                    //         '&nbsp;<button type="button" class="item btn btn-success addAvenant" data-toggle="modal" data-id="'.$registrations->id.'" data-target="#addAvenant" title="Ajouter un avenant">
                    //             <i class="zmdi zmdi-plus-circle"></i>
                    //         </button>';
                    // }
                }
                return $link;
            })
            ->addColumn('validity', function ($registrations) {
                if($registrations->isValidRegistration())
                {
                    return '
                    <span class="item btn btn-success" title="Valide">
                        <i class="zmdi zmdi-check-all"></i>
                    </span>';
                }
                return '
                    <span class="item btn btn-danger" title="Invalide">
                        <i class="zmdi zmdi-close-circle-o"></i>
                    </span>';
            })
            ->rawColumns(['edit', 'validity', 'new', 'data_flow', 'smartphone.imei'])
            ->editColumn('new', function($registrations){
                return ($registrations->new ? '<h4><span class="badge badge-success">Nouveau</span></h4>' : '<h4><span class="badge badge-secondary">Vu</span></h4>');
            })
            ->editColumn('data_flow', function($registrations){
                return $registrations->data_flow->format('Y-m-d');
            })
            ->make(true);
        }
        return view('inscription.listing-registrations', compact('registrations', 'new_registrations'));
    }

    public function listingNewRegistrations()
    {
        $new_memberships = Registration::status(new RegistrationStatus('newAdded'))->get();
        // Registration::where('new', 1)
        //     ->update(['new' => 0]);
        return response()->json($new_memberships);
    }

    public function get_imei($imei = null, Request $request)
    {
        if (!is_null($imei)) {
            return response()->json(Smartphone::where('imei', $imei)->first());
        }
        $errors = [];
        if ($request->imeiList) {
            $imeiList = explode(',', $request->imeiList);
            foreach ($imeiList as $imei) {
                if ($imei && !(Smartphone::where('imei', trim($imei))->first())) {
                    array_push($errors, $imei);
                }
            }
            if ($errors) {
                return response()->json(['errors' => $errors, 'status' => 0]);
            }
            return response()->json(['status' => 1]);
        }
        return response()->json(Smartphone::select('imei')->doesntHave('registration')->get());
    }

    // public function getSmartphoneByImei( $imei )
    // {
    //     $smartphone = Smartphone::where('imei', $imei)->first();
    //     $smartphone->model->brand;
    //     return response()->json($smartphone);
    // }

    public function checkStatus($id) 
    {
        $registration = Registration::where('id', $id)->first();
        if($registration && Auth::User()->hasRole('aon'))
        {
            $registration->new = 0;
            $registration->save();
            // return response()->json(['msg' => 'Cette souscription est consédérer comme vu.']);
        }
    }

    public function export()
    {
        // $registrations = Registration::whereDate('created_at', Carbon::yesterday()->toDateString())->get();
        $registrations = Registration::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d').'%')->get();
        if (!$registrations->isEmpty()) {
            $file_name = time().'_Liste_des_souscriptions.xlsx';
            foreach ($registrations as $registration) {
                $registration->smartphone->model->brand;
                $registration->client;
            }
            return Excel::download(new ExcelDoc($registrations, 'export.registrations', 'registrations', null), $file_name);
            // $excel = Excel::store(new ExcelDoc($registrations), $file_name);
            // return response()->json(['msg' => 'Votre export est effectué.', 'name' => $file_name, 'file' => public_path('\storage\export\\').$file_name, 'excel' => $excel]);
        }
        return response()->json(['msg' => 'Aucune souscriptions est faite aujourd\'hui', 'status' => 404]);
    }
}
