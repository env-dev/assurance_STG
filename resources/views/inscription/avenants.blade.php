@extends('layout.main')

@section('css')
@endsection

@section('title','La liste des avenants')

@section('content')
<div class="col-4 offset-md-4">
    <h2>La liste des Avenants</h2>
</div>
<div class="col-md-12">
    <a class="btn btn-primary m-l-10 m-b-10" href="{{ url('registration') }}" id="new_memberships" >Ajouter une souscription
    </a>
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3 text-center" id="registration-list">
            <thead>
                <tr>
                    <th>Réf. mandat</th>
                    <th>Extension ajouté</th>
                    <th>Date d'effet</th>
                    <th>Surprime</th>
                    <th>Réf. souscription</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>   
</div>
@endsection

@section('js')
@endsection