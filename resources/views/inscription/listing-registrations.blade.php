@extends('layout.main')

@section('css')
@endsection

@section('title','Nouvelles adhésions')

@section('content')
<div class="col-md-12">
    @if ($new_registrations)
        <a class="btn btn-primary m-l-10 m-b-10" href="javascript:void(0)" id="new_memberships" >
            <span class="badge badge-light">{{ $new_registrations }}</span>&nbsp;Nouvelles souscriptions
        </a>
    @endif
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3" id="registration-list">
            <thead>
                <tr>
                    <th>Réf mandat</th>
                    <th>Date de flux de données</th>
                    <th>Créer le</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <!-- <tbody>
                @foreach ($registrations as $registration)
                <tr>
                    <td>{{ $registration->mandat_num }}</td>
                    <td>{{ $registration->data_flow }}</td>
                    <td>{{ $registration->created_at }}</td>
                    <td><span class="{{ ($registration->new) ? 'badge badge-info' : 'badge badge-light' }}">
                    {{ ($registration->new) ? 'Nouveau' : 'Vu' }}
                    </span></td>
                    <td>
                        <a class="item" data-toggle="tooltip" href='{{ url("registration/$registration->id/edit") }}' data-placement="top" title="" data-original-title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody> -->
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $("#registration-list").DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: "{{ asset('/js/lang/dataTables.french.json') }}"
            },
            ajax: "/getRegistrations",
            columns: [
                { data: "mandat_num", name: "mandat_num", orderable: false, searchable: true },
                { data: "data_flow",name: "data_flow" },
                { data: "created_at", name: "created_at" },
                { data: "new", name: "new" },
                { data: "edit", name: "edit", orderable: false, searchable: true },
            ]
        });    
    } );
</script>
@endsection