@extends('layout.main')

@section('css')
@endsection

@section('title','La liste des réparations')

@section('content')
<div class="col-4 offset-md-4">
    <h2>La liste des réparations</h2>
</div>
<div class="col-md-12">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3 text-center" id="reparations-list">
            <thead>
                <tr>
                    <th>Réf mandat</th>
                    <th>Date du sinistre</th>
                    <th>La décision AON</th>
                    <th>La date de réparation</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        var reparations_list = null;

        function initDataTable() {
            reparations_list = $("#reparations-list").DataTable({
                processing: true,
                serverSide: true,
                initComplete: function( settings, json ) {
                },
                language: {
                    url: "{{ asset('/js/lang/dataTables.french.json') }}"
                },
                ajax: "/listing-reparations",
                columns: [
                    { data: "sinister.registration.mandat_num", name: "sinister.registration.mandat_num", orderable: false, searchable: true },
                    { data: "sinister.date_sinister", name: "sinister.date_sinister" },
                    { data: "sinister.aon_decision",name: "sinister.aon_decision" },
                    { data: "date_reparation", name: "date_reparation" }
                ]
            });
        }

        function refreshDataTable() {
            reparation_list.destroy();
            initDataTable();
        }

        initDataTable();
    } );
</script>
@endsection