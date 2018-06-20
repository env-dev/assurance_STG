<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Helpers\PDFClass;
use App\Helpers\RegistrationStatus;
use Yajra\Datatables\Datatables;
use App\Registration;
use App\Smartphone;
use App\Client;
use Auth;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            'nature' => 'required',
            'num_id' => 'required',
            'imei' => 'required',
            'date_flow_data' => 'required',
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
        $smartphone->model->brand;
        
        $registration = new Registration;

        $registration->mandat_num = str_random(10);
        $registration->data_flow = request('date_flow_data');
        $registration->guarantee = request('guarantee');
        $registration->total_ttc = intval(request('total_ttc'));
        $registration->smartphone_id = $smartphone->id;
        $registration->client_id = $client->id;

        $registration->save();
        $pdf = new PDFClass;
        return $pdf->downloadPDF($client, $registration, $smartphone);
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
        ->where('new', 1)
        ->first();
        if(Auth::User()->hasRole('aon'))
        {
            $registration->new = 0;
            $registration->save();
        }
        return view('inscription.edit-registration')->with(['registration' => $registration]);
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
        // $new_memberships = Registration::with('smartphone.model.brand')->where('new', 1)->get();
        // $new_memberships = Registration::status(new RegistrationStatus('newAdded'))->get();
        // $new_memberships = $new_memberships->map(function ($item, $key) {
        //    return $item->smartphone;
        // });
        $registrations = Registration::orderBy('data_flow', 'desc')->get();
        $new_registrations = Registration::status(new RegistrationStatus('newAdded'))->count();
        // dd(Datatables::of($registrations)->make(true));
        if($request->ajax()) {
            return Datatables::of($registrations)
            ->addIndexColumn()
            ->addColumn('edit', function ($registrations) {
                return '
                <a class="item btn btn-info" href="/registration/'.$registrations->id.'" title="Edit">
                    <i class="zmdi zmdi-eye"></i>
                </a>';
            })
            ->rawColumns(['edit'])
            ->editColumn('new', function($registrations){
                return ($registrations->new ? 'Nouveau' : 'Vu');
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

    public function get_imei()
    {
        return response()->json(Smartphone::select('imei')->whereNull('deleted_at')->get());
    }

    public function getSmartphoneByImei( $imei )
    {
        $smartphone = Smartphone::where('imei', $imei)->first();
        $smartphone->model->brand;
        return response()->json($smartphone);
    }
}
