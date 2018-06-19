@extends('layout.main')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills  nav-fill card-header-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link disabled" id="pills-permission-tab" data-toggle="pill" href="#pills-permission" role="tab" aria-controls="pills-permission" aria-selected="true">Permission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-role-tab" data-toggle="pill" href="#pills-role" role="tab" aria-controls="pills-role" aria-selected="false">Role</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-user-tab" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user" aria-selected="false">User</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade" id="pills-permission" role="tabpanel" aria-labelledby="pills-permission-tab">
                        <!-- permission Section -->
                        @include('roles_permissions_users.permission')
                        <!-- End permission Section -->
                    </div>
                    <div class="tab-pane fade show active" id="pills-role" role="tabpanel" aria-labelledby="pills-role-tab">
                        <!-- role Section -->
                        @include('roles_permissions_users.role')
                        <!-- End role Section -->
                    </div>
                    <div class="tab-pane fade" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
                        <!-- user Section -->
                        @include('roles_permissions_users.user')
                        <!-- End user Section -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('roles_permissions_users.update')
@endsection
@section('js')
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/register.js') }}"></script>
@endsection