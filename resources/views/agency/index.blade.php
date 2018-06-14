@extends('layout.main')
@section('title','Appareil Information')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection
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
                        <form class="cmxform" >
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
                                <input id="agence_tel_add" name="agence_tel_add" type="tel" class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="form-group">
                                <label for="agence_email_add" class="control-label mb-1">Email</label>
                                <input id="agence_email_add" name="agence_email_add" type="email" class="form-control" aria-required="true" aria-invalid="false" >
                            </div>
                            <div class="form-group">
                                <label for="agence_ville_add" class="control-label mb-1">Ville</label>
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
                            <table style="width:100%" class="table table-borderless table-striped table-earning text-center" id="">
                                <thead>
                                    <tr>
                                        <th>Agence</th>
                                        <th>Nom</th>
                                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Omran</td>
                                        <td>Jhon Doe</td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-" data-id="'.$phone->id.'" title="Supprimer"><i class="fa fa-times"></i></button>
                                            <button type="button" class="btn btn-info update-" data-id="'.$phone->id.'" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>
                                            <button type="button" class="btn btn-warning update-" data-id="'.$phone->id.'" title="info">&nbsp;<i class="fa fa-info"></i>&nbsp;</i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Omran</td>
                                        <td>Jhon Doe</td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-" data-id="'.$phone->id.'" title="Supprimer"><i class="fa fa-times"></i></button>
                                            <button type="button" class="btn btn-info update-" data-id="'.$phone->id.'" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>
                                            <button type="button" class="btn btn-warning update-" data-id="'.$phone->id.'" title="info">&nbsp;<i class="fa fa-info"></i>&nbsp;</i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Omran</td>
                                        <td>Jhon Doe</td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-" data-id="'.$phone->id.'" title="Supprimer"><i class="fa fa-times"></i></button>
                                            <button type="button" class="btn btn-info update-" data-id="'.$phone->id.'" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>
                                            <button type="button" class="btn btn-warning update-" data-id="'.$phone->id.'" title="info">&nbsp;<i class="fa fa-info"></i>&nbsp;</button>
                                        </td>
                                    </tr>
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
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/appareil.js') }}"></script>
@endsection