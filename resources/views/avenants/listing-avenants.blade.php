@extends('layout.main')

@section('css')
<style>
.infos_plus {
    padding: 0 15px;
}
</style>
@endsection

@section('title','La liste des avenants')

@section('content')
<div class="col-4 offset-md-4">
    <h2>La liste des Avenants</h2>
</div>
<div class="col-md-12">
<a class="btn btn-outline-dark m-l-10 m-b-10" href="{{ url('export-avenants') }}" target="_blank" id="export">Exporter</a>
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3 text-center" id="avenants-list">
            <thead>
                <tr>
                    <th>Réf. mandat</th>
                    <th>Extension ajouté</th>
                    <th>Date d'effet</th>
                    <th>Surprime</th>
                    <th>Réf. souscription</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div> 
    <!-- Begin consulting registation modal -->
    <div class="modal fade" id="consult_avenant" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollmodalLabel">Informations sur l'avenant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>N° mandat:</strong> </label>
                            <span class="col-lg-6" id="num_mandat"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Extension ajouté:</strong> </label>
                            <span class="col-lg-6" id="extension_added"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Date d'effet:</strong> </label>
                            <span class="col-lg-6" id="effective_date"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Montant ajouté:</strong> </label>
                            <span class="col-lg-6" id="premium_added"></span>
                        </div>
                        <hr>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Nom & prénom:</strong> </label>
                            <span class="col-lg-6" id="full_name_client"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Adresse:</strong> </label>
                            <span class="col-lg-6" id="address_client"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Telephone:</strong> </label>
                            <span class="col-lg-6" id="tel_client"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Ville:</strong> </label>
                            <span class="col-lg-6" id="city_client"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Nature:</strong> </label>
                            <span class="col-lg-6" id="client_type"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6" id="id_type"><strong></strong></label>
                            <span class="col-lg-6" id="id_num_client"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>N° IMEI:</strong> </label>
                            <span class="col-lg-6" id="imei_device"></span>
                        </div>
                        <!-- Brand & model infos -->
                        <div class="col-lg-12 text-center"  data-toggle="collapse" data-target="#infos_plus" aria-expanded="false" aria-controls="infos_plus" style="/* background: #434343; */border-bottom: 1px solid black;margin-bottom: 15px;">
                            <button type="button"><i class="fa fa-angle-double-down"></i></button>
                        </div>
                        <hr>
                        <div class="row infos_plus collapse" id="infos_plus">
                            <div class="col-lg-6">
                                <label class="col-lg-6"> <strong>Marque:</strong> </label>
                                <span class="col-lg-6" id="brand_device"></span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-lg-6"> <strong>Modéle:</strong> </label>
                                <span class="col-lg-6" id="model_device"></span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-lg-6"> <strong>Prix:</strong> </label>
                                <span class="col-lg-6" id="device_price"></span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-lg-6"> <strong>Guarantie:</strong> </label>
                                <span class="col-lg-6" id="guarantee_device"></span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-lg-6"> <strong>Agence:</strong> </label>
                                <span class="col-lg-6" id="agency_reg"></span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-lg-6"> <strong>Prix total TTC:</strong> </label>
                                <span class="col-lg-6" id="total_price_reg"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-id="0" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END -->
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var avenants_list = null;

        function initDataTable() {
            avenants_list = $("#avenants-list").DataTable({
                processing: true,
                serverSide: true,
                initComplete: function( settings, json ) {
                    getAvenant();
                //     getRegistration();
                },
                language: {
                    url: "{{ asset('/js/lang/dataTables.french.json') }}"
                },
                ajax: "/getAvenants",
                columns: [
                    { data: "mandat_num", name: "mandat_num", orderable: false, searchable: true },
                    { data: "extension_added",name: "extension_added" },
                    { data: "effective_date", name: "effective_date" },
                    { data: "add_premium", name: "add_premium", orderable: true, searchable: false },
                    { data: "ref_reg", name: "ref_reg", orderable: false, searchable: true },
                    { data: "edit", name: "edit", orderable: false, searchable: true },
                ]
            });
        }


        function getAvenant(){
            $(".consult_avenant").on("click", function(){
                var ID = $(this).attr('data-id');

                $.ajax({
                    type: 'GET',
                    url: '/getAvenant/'+ID,
                    dataType: 'json',
                    success: function(data){
                        var guarantee = 'F1';
                        var avenant = data.avenant;
                        var agency = data.agency;
                        var extension_added = (avenant.extension_added == 110) ? 'F2':'';
                        var effective_date = avenant.effective_date.split(' ');
                        var birth_date = avenant.registration.client.birth_date.split(' ');
                        var data_flow = avenant.registration.data_flow.split(' ');
                        // fill the model with registration data
                        $("#num_mandat").text(avenant.mandat_num);
                        $("#extension_added").text(extension_added);
                        $("#effective_date").text(effective_date[0]);
                        $("#premium_added").text(avenant.add_premium);
                        $("#full_name_client").text(avenant.registration.client.first_name + ' ' +avenant.registration.client.last_name);
                        $("#email_client").text(avenant.registration.client.email);
                        $("#birthdate_client").text(birth_date[0]);
                        $("#address_client").text(avenant.registration.client.address);
                        $("#tel_client").text(avenant.registration.client.tel);
                        $("#city_client").text(avenant.registration.client.city);
                        $("#client_type").text(avenant.registration.client.nature);
                        $("#id_num_client").text(avenant.registration.client.num_id);
                        $("#id_type strong").text(avenant.registration.client.type_id);
                        $("#imei_device").text(avenant.registration.smartphone.imei);
                        $("#brand_device").text(avenant.registration.smartphone.model.brand.name);
                        $("#model_device").text(avenant.registration.smartphone.model.name);
                        $("#device_price").text(avenant.registration.smartphone.model.price_ttc);
                        $("#guarantee_device").text(guarantee);
                        $("#data_flow_date").text(data_flow[0]);
                        $("#agency_reg").text(agency.full_name);
                        $("#total_price_reg").text(avenant.registration.total_ttc);
                    }
                });
            });
        }


        initDataTable()

        $("#export").on("click", function(e) {
            var self = $(this);
            if (self.attr('canExport') == undefined) {
                e.preventDefault();
                $.ajax({
                    url: 'export-avenants',
                    success: function(response) {
                        if (response.status != undefined) {
                            swal({
                                title: 'Export',
                                text: response.msg,
                                icon: "error",
                            })
                            return;
                        }
                        self.attr('canExport', true);
                        self.trigger('click');
                    }
                })
            }else{
                swal({
                    title: 'Export',
                    text: 'L\'export est effectué',
                    icon: "success",
                })
                window.location.target = '_blank';
                window.location = 'export-avenants';
            }
        })
    })
</script>
@endsection