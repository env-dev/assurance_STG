<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Helpers\PDFClass;
use App\Smartphone;
use App\Registration;
use App\Client;

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
            'mandat_num' => 'required',
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

        // $client->save();

        $smartphone = Smartphone::where('imei', request('imei'))->first();
        
        $registration = new Registration;

        $registration->mandat_num = request('mandat_num');
        $registration->data_flow = request('date_flow_data');
        $registration->guarantee = request('guarantee');
        $registration->total_ttc = intval(request('total_ttc'));
        $registration->smartphone_id = $smartphone->id;
        $registration->client_id = $client->id;

        // $registration->save();
        $pdf = new PDFClass;
        $pdf->downloadPDF($client, $registration);
        
        return redirect('registration')->with('msg', 'Ajout réussi');
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
