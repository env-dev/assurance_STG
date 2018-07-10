@extends('layout.main')

@section('css')
@endsection

@section('title','Nouvelles adhésions')

@section('content')
<div class="col-4 offset-md-4 mb-3">
    <h2>Ajouter un sinistre</h2>
</div>
<div class="row">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body row">
                <div class="col-6 ">
                    <div class="form-group">
                        <label for="name" class="control-label mb-1">Nom</label>
                        <input id="name" name="last_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>
                </div>
                <div class="col-6">
                    <label for="x_card_code" class="control-label mb-1">Prénom</label>
                    <div class="input-group">
                        <input id="first_name" name="first_name" type="text" class="form-control cc-cvc" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection