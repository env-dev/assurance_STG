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
use Session;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->has('reg_id')) { //In case the device has to change, create a new registration, with the old guarantee.
            $msg = 'Vous êtes rediregé pour ajouter une nouvelle souscription.';
            $registration = Registration::find($request->session()->get('reg_id'));
            $avenant = Avenant::where('registration_id', $registration->id)->first();
            if ($avenant) {
                return view('inscription.main')->with(['guarantee' => $avenant->extension_added, 'msg' => $msg]);
            }
            return view('inscription.main')->with(['guarantee' => $registration->guarantee, 'msg' => $msg]);
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
            'imeiList' => 'required',
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
        
        //STore more than smartpone here
        $imeiList = array_filter(array_map(function($imei) {
            return trim($imei);
        }, explode(',', $request->imeiList)));
        $agency = Agence::find(request('agency'));
        $agency_id = Auth::user()->hasRole('admin') ? $agency->id : Auth::user()->agence->id;
        $pdf_Registration = $smartphones = $price_smartphone = null;

        $request->session()->forget('reg_id');
        $pdf = new PDFClass;

        if (count($imeiList) > 1) {
            $smartphones = Smartphone::whereIn('imei', $imeiList)->get();
            $smartphones->status = 3;
            $smartphones->each(function($item, $key) use($client, $agency_id){
                $price_smartphone = $item->model->price_ttc;
                $item->model->brand;
    
                $registration = new Registration;
                $registration->mandat_num = str_random(10);
                $registration->data_flow = \Carbon\Carbon::now();
                $total_ttc = $price_smartphone;
                if(request('guarantee') == '110'){
                    $total_ttc = $price_smartphone + ($price_smartphone * 10)/100;
                }
                $registration->total_ttc = $total_ttc;
                $registration->smartphone_id = $item->id;
                $registration->client_id = $client->id;
                $registration->agency_id = $agency_id;
                $registration->guarantee = request('guarantee');
                // $registration->save();
                // $item->save();
            });
        }else {
            $smartphones = Smartphone::where('imei', $imeiList[0])->get();
            $smartphones[0]->model->brand;
            $smartphones[0]->status = 3;
            $price_smartphone = $smartphones[0]->model->price_ttc;
            $pdf_Registration = new Registration;
            $pdf_Registration->mandat_num = str_random(10);
            $pdf_Registration->data_flow = \Carbon\Carbon::now();
            $total_ttc = $price_smartphone;
            if(request('guarantee') == '110'){
                $total_ttc = $price_smartphone + ($price_smartphone * 10)/100;
            }
            $pdf_Registration->total_ttc = $total_ttc;
            $pdf_Registration->smartphone_id = $smartphones[0]->id;
            $pdf_Registration->client_id = $client->id;
            $pdf_Registration->agency_id = $agency_id;
            $pdf_Registration->guarantee = request('guarantee');
            // $pdf_Registration->save();
            // $smartphones->save();

        }
        Auth::user()->notif('registration');
        if (request('guarantee') == '110') {
            return $pdf->downloadPDF('pdfs.registration', $client, $pdf_Registration, $smartphones, $agency);
        }
        return $pdf->downloadPDF('pdfs.AAM_F1', $client, $pdf_Registration, $smartphones, $agency);
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
                    return $value->agency_id == Auth::user()->agence_id;
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
            $imeiList = array_filter(explode(',', $request->imeiList));
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

    public function export(Request $request)
    {
        // $registrations = Registration::whereDate('created_at', Carbon::yesterday()->toDateString())->get();
        $exportDate = explode(' ', $request->exportDates);
        $from = trim($exportDate[0]);
        $to = trim($exportDate[2]);
        // $registrations = Registration::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d').'%')->get();
        $registrations = Registration::whereBetween('created_at', [$from." 00:00:00", $to." 23:59:59"])->get();
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
        return response()->json(['msg' => 'Aucune souscriptions a été trouvé.', 'status' => 404]);
    }


    public function publicIndex(){
        return view('public2');
    }

    public function publicRegister(Request $request){
        $rules = [
            'last_name'  => 'required|min:3',
            'first_name'  => 'required|min:3',
            'city' => 'required',
            'nature' => 'required',
            'num_id' => 'required',
            'type_id' => 'required',
            'date_flow' => 'required',
            'imei' => 'required',
        ];
        $this->validate($request,$rules);
        // Create de client
        $client = new Client;

        $client->first_name = request('first_name');
        $client->last_name = request('last_name');
        $client->tel = request('tel');
        $client->email = request('email');
        $client->city = request('city');
        $client->address = request('address') ?? 'No address';
        $client->nature = request('nature');
        $client->type_id = request('type_id');
        $client->num_id = request('num_id');
        $client->birth_date = \Carbon\Carbon::now(); //request('birth_date');
        $client->save();
        // Save the smartphone
        $smartphone = Smartphone::where('imei', request('imei'))->first();
        if (is_null($smartphone)) {
            return response()->json(["msg" => "Le smartphone n'existe pas", 'code' => 0]);
        }
        $smartphone->model->brand;
        $smartphone->status = 3;
        // Create the registration
        $registration = new Registration;
        $registration->mandat_num = str_random(10);
        $registration->guarantee = 100;
        $registration->data_flow = request('date_flow');
        $total_ttc = $smartphone->model->price_ttc;
        if(request('guarantee') == '110'){
            $total_ttc = $smartphones->model->price_ttc + ($smartphones->model->price_ttc * 10)/100;
        }
        $registration->total_ttc = $total_ttc;
        $registration->smartphone_id = $smartphone->id;
        $registration->client_id = $client->id;
        $registration->agency_id = 1;
        
        $smartphone->save();
        $registration->save();
        return response()->json(["msg" => "Votre souscription est éffectué.", 'code' => 1]);
    }
}
