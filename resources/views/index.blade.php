@extends('layout.main')
@section('content')
<div class="section__content section__content--p30">
            <h1 class="text-center">Welcome {{ Auth::user()->name }}</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © {{ Date('Y') }} <a href="https://stgtelecom.ma" target="_blank">STG TELECOM</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection