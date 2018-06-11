@extends('layout.main')

@section('css')
<style>
.ui-autocomplete-loading {
    background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
  }
</style>
@endsection

@section('title','Inscription')

@section('content')
<div class="row">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills  nav-fill card-header-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-client-tab" data-toggle="pill" href="#pills-client" role="tab" aria-controls="pills-marque"
                            aria-selected="true">Client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-device-tab" data-toggle="pill" href="#pills-device" role="tab" aria-controls="pills-model"
                            aria-selected="false">Appareil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-inscription-tab" data-toggle="pill" href="#pills-inscription" role="tab" aria-controls="pills-phone"
                            aria-selected="false">Inscription</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                @if (session('msg'))
                    <div class="alert alert-success text-center">
                        {{ session('msg') }}
                    </div>
                @endif
                <div class="default-tab">
                    <form action="{{ action('RegistrationController@store') }}" id="inscriptionForm" method="post" enctype="multipart/form-data" class="form-horizontal" >
                        {{ csrf_field() }}  
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-client" role="tabpanel" aria-labelledby="pills-marque-tab">
                                <!-- Client Section -->
                                @include('inscription.client')
                                <!-- End Client Section -->
                            </div>
                            <div class="tab-pane fade" id="pills-device" role="tabpanel" aria-labelledby="pills-model-tab">
                                <!-- Appareil Section -->
                                @include('inscription.appareil')
                                <!-- End Appareil Section -->
                            </div>
                            <div class="tab-pane fade" id="pills-inscription" role="tabpanel" aria-labelledby="pills-phone-tab">
                                <!-- Inscription Section -->
                                @include('inscription.inscription')
                                <!-- End Inscription Section -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/inscription.js') }}"></script>
@endsection
