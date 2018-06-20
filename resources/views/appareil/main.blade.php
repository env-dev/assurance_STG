@extends('layout.main')
@section('title','Appareil Information')
@section('css')
@endsection
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills  nav-fill card-header-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link disabled" id="pills-marque-tab" data-toggle="pill" href="#pills-marque" role="tab" aria-controls="pills-marque" aria-selected="true">Marque</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-model-tab" data-toggle="pill" href="#pills-model" role="tab" aria-controls="pills-model" aria-selected="false">Model</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-phone-tab" data-toggle="pill" href="#pills-phone" role="tab" aria-controls="pills-phone" aria-selected="false">Appareil</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade" id="pills-marque" role="tabpanel" aria-labelledby="pills-marque-tab">
                        <!-- Marque Section -->
                        @include('appareil.marque')
                        <!-- End Marque Section -->
                    </div>
                    <div class="tab-pane fade show active" id="pills-model" role="tabpanel" aria-labelledby="pills-model-tab">
                        <!-- Model Section -->
                        @include('appareil.model')
                        <!-- End Model Section -->
                    </div>
                    <div class="tab-pane fade" id="pills-phone" role="tabpanel" aria-labelledby="pills-phone-tab">
                        <!-- Phone Section -->
                        @include('appareil.phone')
                        <!-- End Phone Section -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('appareil.update_modal')
@endsection
@section('js')
<script src="{{ asset('js/appareil.js') }}"></script>
@endsection