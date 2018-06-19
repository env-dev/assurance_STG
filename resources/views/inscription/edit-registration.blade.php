@extends('layout.main')

@section('css')
@endsection

@section('title','editer une registration')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">Registration</div>
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Informations de la souscription</h3>
                </div>
                <hr>
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>Réf mandat</th>
                                <th>Date de flux de données</th>
                                <th>Créer le</th>
                                <th>Total TTC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $registration->mandat_num }}</td>
                                <td>{{ $registration->data_flow }}</td>
                                <td>{{ $registration->created_at }}</td>
                                <td>{{ $registration->total_ttc }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">Appareil</div>
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Informations sur l'appareil</h3>
                </div>
                <hr>
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>IMEI</th>
                                <th>Nom du modèle</th>
                                <th>Nom de la marque</th>
                                <th>Prix de l'appareil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $registration->smartphone->imei }}</td>
                                <td>{{ $registration->smartphone->model->name }}</td>
                                <td>{{ $registration->smartphone->model->brand->name }}</td>
                                <td>{{ $registration->smartphone->model->price_ttc }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection