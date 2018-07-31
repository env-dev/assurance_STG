@extends('layout.main')

@section('css')
<style>
    .invalid {
        border-color: red;
    }
</style>
@endsection

@section('title','Liste des sinistres')

@section('content')
<div class="col-4 offset-md-4">
    <h2>La liste des sinistres</h2>
</div>
<div class="col-md-12">
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3 text-center" id="sinisters-list">
            <thead>
                <tr>
                    <!-- <th>Réf mandat</th> -->
                    <th>CIN/RC</th>
                    <th>Date flux de données</th>
                    <th>Créer le</th>
                    <th>Date sinistre</th>
                    <th>Status</th>
                    <th>Date AON decision</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
    <div>
        @include('sinister.modals.infos-sinister')
    </div>
    <div>
        @include('sinister.modals.confirm-aon-decision')
    </div>
    <div>
        @include('sinister.modals.confirm-reparation')
    </div>
</div>
<!-- END -->
@endsection

@section('js')
<script>
    $(document).ready(function(){
        var sinisters_list = null;

        function getSinisters(){
            $(".consult_sinister").on("click", function(){
                var ID = $(this).attr('data-id');

                $.ajax({
                    type: 'GET',
                    url: '/getSinister/'+ID,
                    dataType: 'json',
                    success: function(sinister){
                        var type_sinister = 'Casse d’écran seule';
                        var date_sinister = sinister.date_sinister.split(' ');
                        var aon_decision = (sinister.aon_decision) ? sinister.aon_decision : 'Aucune décision a été prise.';

                        if (sinister.type_sinister == 20) {
                            type_sinister = 'Casse toutes causes';
                        }else if(sinister.type_sinister == 30){
                            type_sinister = 'Oxydation';
                        }else if(sinister.type_sinister == 40){
                            type_sinister = 'Défaillance constructeur';
                        }

                        $("#full_name_client").text(sinister.registration.client.first_name + ' ' +sinister.registration.client.last_name);
                        $("#sinister_type").text(type_sinister);
                        $("#place_sinister").text(sinister.place_sinister);
                        $("#date_sinister").text(date_sinister[0]);
                        $("#cause_sinister").text(sinister.cause_sinister);
                        $("#model_device").text(sinister.registration.smartphone.model.name);
                        $("#brand_device").text(sinister.registration.smartphone.model.brand.name);
                        $("#imei_device").text(sinister.registration.smartphone.imei);
                        $("#sinister_aon_decision").text(aon_decision);
                        $("#tel_client").text(sinister.registration.client.tel);
                    }
                });
            });

            $(".aon_decision").on("change", function(e) {
                var ID = $(this).attr('data-id');
                var decision = $(this).attr('data-decision');
                $("#confirmAonDecision").attr("data-id", ID);
                $("#confirmAonDecision").attr("data-decision", $(this).val());
                $('#confirmDecision').modal('show');
            })
            
            $(".confirmRep").on("click", function(e) {
                var ID = $(this).attr('data-id');
                $("#confirmReparation").attr("data-id", ID);
            })
        }

        function initDataTable() {
            sinisters_list = $("#sinisters-list").DataTable({
                processing: true,
                serverSide: true,
                initComplete: function( settings, json ) {
                    getSinisters();
                    clearModal();
                },
                language: {
                    url: "{{ asset('/js/lang/dataTables.french.json') }}"
                },
                ajax: "/getSinisters",
                columns: [
                    // { data: "registration.mandat_num", name: "registration.mandat_num", orderable: false, searchable: true },
                    { data: "registration.client.num_id", name: "registration.client.num_id", orderable: false, searchable: true },
                    { data: "data_flow",name: "data_flow" },
                    { data: "created_at", name: "created_at" },
                    { data: "date_sinister", name: "date_sinister", orderable: true, searchable: false },
                    { data: "status", name: "status" },
                    { data: "aon_decision_date", name: "aon_decision_date" },
                    { data: "edit", name: "edit", orderable: false, searchable: true },
                ]
            });
        }

        function refreshDataTable() {
            sinisters_list.destroy();
            initDataTable();
        }

        function clearModal()
        {
            $(".confirmRep").on("click", function() {
                var ID = $(this).attr('data-id')
                $.ajax({
                    url: 'getSinister/'+ID,
                    success: function(sinister) {
                        $("#num_id").text(sinister.registration.client.num_id);
                        $("#tel").text(sinister.registration.client.tel);
                        $("#brand").text(sinister.registration.smartphone.model.brand.name);
                        $("#model").text(sinister.registration.smartphone.model.name);
                        $("#imei").text(sinister.registration.smartphone.imei);
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })

                $('#confirm_reparation').find('input,select, textarea').removeClass('invalid');
                $('#price_ttc_reparation').val('');
                $('#price_ttc_replacement').val('');
                $('#price_ttc_workforce').val('');
                $('#date_reparation').val('');

                $("#confirmReparation").attr('data-id', $(this).attr('data-id'));
            });
        }

        function divValid(hash) {
                var invalids = $(hash).find('input, select, textarea').filter(function(i,el){return !el.checkValidity() }).addClass('invalid');
                return invalids.length===0
            }

        // ----------
        initDataTable();

        $("#confirmAonDecision").on("click", function(e) {
            var ID = $(this).attr("data-id");
            var decision = $(this).attr("data-decision");
            if ($(this).attr("data-decision")) {
                $.ajax({
                    type: 'POST',
                    url: 'setAonDecision/'+ID,
                    data : {decision: $(this).attr("data-decision")},
                    success: function(response) {
                        if (response) {
                            swal({
                                title: 'Décision prise',
                                text: 'L\'opération  a echoué',
                                icon: "error",
                            })
                            if (decision == 'CHG') {
                                window.location = 'registration';
                            }
                        }
                        swal({
                            title: 'Décision prise',
                            text: 'L\'opération  a réussi',
                            icon: "success",
                        })
                        refreshDataTable();
                    },
                    error: function(err) {
                        console.log(err)
                    }
                });
            }else{
                alert('nothing to do.')
            }
        })

        $("#confirmReparation").on("click", function(e) {
            e.preventDefault()

            if (!divValid('#confirm_reparation')) {
                return false;
            }
            var ID = $(this).attr('data-id');
            var price_ttc_reparation = $("#price_ttc_reparation").val();
            var price_ttc_replacement = $("#price_ttc_replacement").val();
            var price_ttc_workforce = $("#price_ttc_workforce").val();
            var date_reparation = $("#date_reparation").val();

            $.ajax({
                type: 'POST',
                url: 'setReparationStatus/'+ID,
                data: {
                    price_ttc_reparation: price_ttc_reparation,
                    price_ttc_replacement: price_ttc_replacement,
                    price_ttc_workforce: price_ttc_workforce,
                    date_reparation: date_reparation
                },
                success: function(response) {
                    if (response) {
                        swal({
                            title: 'Confirmation de réparation',
                            text: 'Le status est mis à jour',
                            icon: 'success'
                        })
                        refreshDataTable()
                    }else {
                        swal({
                            title: 'Confirmation de réparation',
                            text: 'Echec du mis à jour',
                            icon: 'error'
                        })
                    }
                },
                error: function(err) {
                    console.log(err)
                    swal({
                            title: 'Erreur serveur',
                            text: 'Echec du mis à jour',
                            icon: 'error'
                        })
                }
            });
        })
    })
</script>
@endsection