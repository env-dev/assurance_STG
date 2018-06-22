@extends('layout.main')
@section('title','Agence')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Ajouter Nouveau Agence
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <form id="insert-agence-frm" >
                            <div class="form-group">
                                <label for="agence_name_add" class="control-label mb-1">Nom D'agence</label>
                                <input id="agence_name_add" name="agence_name_add" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="form-group">
                                <label for="agence_fullname_add" class="control-label mb-1">Nom Complet</label>
                                <input id="agence_fullname_add" name="agence_fullname_add" type="text" class="form-control" aria-required="true" aria-invalid="false">
                            </div>
                            <div class="form-group">
                                <label for="agence_reference_add" class="control-label mb-1">Reference</label>
                                <input id="agence_reference_add" name="agence_reference_add" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="form-group">
                                <label for="agence_tel_add" class="control-label mb-1">Telephone</label>
                                <input id="agence_tel_add" name="agence_tel_add" type="tel" class="form-control phone" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="form-group">
                                <label for="agence_email_add" class="control-label mb-1">Email</label>
                                <input id="agence_email_add" name="agence_email_add" type="email" class="form-control" aria-required="true" aria-invalid="false" >
                            </div>
                            <div class="form-group">
                                <label for="agence_email_add" class="control-label mb-1">Adresse</label>
                                <textarea id="agence_address_add" name="agence_address_add" class="form-control" aria-required="true" aria-invalid="false"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="agence_ville_add" class="control-label mb-1">Ville</label>
                                <select name="agence_city_add" id="agence_city_add" class="form-control" required>
                                    <option value=""></option>
                                    @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button id="insert-agence" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa fa-plus-square"></i>&nbsp;
                                    <span id="btn-submit"> Ajouter</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="table-responsive table--no-card m-b-30">
                            <table style="width:100%" class="table table-borderless table-striped table-earning text-center" id="agency-table">
                                <thead>
                                    <tr>
                                        <th>Agence</th>
                                        <th>Nom</th>
                                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agences as $agence)
                                    <tr>
                                        <td>{{$agence->name}}</td>
                                        <td>{{$agence->full_name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-agency" data-id="{{ $agence->id }}" title="Supprimer"><i class="fa fa-times"></i></button>
                                            <button type="button" class="btn btn-info update-agency" data-id="{{ $agence->id }}" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>
                                            <button type="button" class="btn btn-warning info-agency" data-id="{{ $agence->id }}" title="info">&nbsp;<i class="fa fa-info"></i>&nbsp;</i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('agency.view_update')
@endsection
@section('js')
<script src="{{ asset('js/agency.js') }}"></script>
@endsection