@extends('layout.main')

@section('css')
@endsection

@section('title','Nouvelles adhésions')

@section('content')
<div class="col-4 offset-md-4">
    <h2>La liste des Souscriptions</h2>
</div>
<div class="col-md-12">
    @role(['admin','agence'])
    <a class="btn btn-primary m-l-10 m-b-10" href="{{ url('registration') }}" id="new_memberships" >Ajouter une souscription</a>
    @endrole
    @role(['admin','aon'])
    <a class="btn btn-outline-dark m-l-10 m-b-10" href="{{ url('export-registrations') }}" target="_blank" id="export">Exporter</a>
    @endrole
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3 text-center" id="registration-list">
            <thead>
                <tr>
                    <th>Réf mandat</th>
                    <th>Date de flux de données</th>
                    <th>Créer le</th>
                    <th>Validité</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
    <!-- Begin consulting registation modal -->
    <div class="modal fade" id="consult_reg" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollmodalLabel">Informations sur la souscription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Nom & prénom:</strong> </label>
                            <span class="col-lg-6" id="full_name_client"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Email:</strong> </label>
                            <span class="col-lg-6" id="email_client"></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-lg-6"> <strong>Date de naissance:</strong> </label>
                            <span class="col-lg-6" id="birthdate_client"></span>
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
                            <label class="col-lg-6"> <strong>IMEI:</strong> </label>
                            <span class="col-lg-6" id="imei_device"></span>
                        </div>
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
                            <label class="col-lg-6"> <strong>Flux de données:</strong> </label>
                            <span class="col-lg-6" id="data_flow_date"></span>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="consulted_reg" data-id="0" data-dismiss="modal">OK</button>
                    <a class="btn btn-primary" id="print_reg" data-id="0" href="">Imprimer</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END -->
    <!-- END DATA TABLE-->
    <div class="modal fade" id="addAvenant" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Informations sur l'avenant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">La garantie à ajouter</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="select" id="extensions" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="disabled-input" class=" form-control-label">Surprime TTC</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="hidden" id="price_ttc">
                                <input type="hidden" id="registration_id">
                                <input type="text" id="surprime_ttc" placeholder="Surprime..." disabled="" class="form-control">
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="add_avenant" data-dismiss="modal">Confirmer</button>
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
        var registrations_list = null;

        function initDataTable() {
            registrations_list = $("#registration-list").DataTable({
                processing: true,
                serverSide: true,
                initComplete: function( settings, json ) {
                    getAvenant();
                    getRegistration();
                },
                language: {
                    url: "{{ asset('/js/lang/dataTables.french.json') }}"
                },
                ajax: "/getRegistrations",
                columns: [
                    { data: "mandat_num", name: "mandat_num", orderable: false, searchable: true },
                    { data: "data_flow",name: "data_flow" },
                    { data: "created_at", name: "created_at" },
                    { data: "validity", name: "validity", orderable: true, searchable: false },
                    { data: "new", name: "new" },
                    { data: "edit", name: "edit", orderable: false, searchable: true },
                ]
            });
        }

        function refreshDataTable() {
            registrations_list.destroy();
            initDataTable();
        }

        function getAvenant() 
        {
            $(".addAvenant").on("click", function(){
                    var ID = $(this).attr('data-id');
                    $('#surprime_ttc').val(0);
                    $('#registration_id').val(ID);
                    $.ajax({
                        type:'GET',
                        url: '/getRegistration/'+ID,
                        dataType: 'json',
                        success: function(registration){
                            $("#price_ttc").val(registration.smartphone.model.price_ttc);
                            $("#extensions").html();
                            var extensions = '<option value="0">----</option>';
                            if (registration.guarantee == 100){
                                // if(registration.avenant.length && registration.avenant[0].extension_added == 110) {
                                if(!registration.avenant.length) {
                                    extensions += '<option value="110">F2</option>';
                                }
                                // else if(registration.avenant.length && registration.avenant[0].extension_added == 111) {
                                //     extensions += 'Pas de guarantie';
                                // }else {
                                //     extensions += '<option value="110">F2</option>';
                                //     extensions += '<option value="111">F3</option>';
                                // }
                                // extensions += '<option value="110">F2</option>';
                            }
                            // else if (registration.guarantee == 110){
                            //     extensions += '<option value="111">F3</option>';
                            // }           
                            $("#extensions").html(extensions);
                        }
                    });
                });
        }
        function getRegistration(){
            $(".consult_reg").on("click", function(){
                var ID = $(this).attr('data-id');

                $.ajax({
                    type: 'GET',
                    url: '/getRegistration/'+ID,
                    dataType: 'json',
                    success: function(data){
                        var guarantee = 'F1';
                        var registration = data.registration;
                        var agency = data.agency;
                        var birth_date = registration.client.birth_date.split(' ');
                        var data_flow = registration.data_flow.split(' ');
                        
                        if (data.guarantee == 110) {
                            guarantee = 'F2';
                        }else if(data.guarantee == 111){
                            guarantee = 'F3';
                        }
                        // fill the model with registration data
                        $("#full_name_client").text(registration.client.first_name + ' ' +registration.client.last_name);
                        $("#email_client").text(registration.client.email);
                        $("#birthdate_client").text(birth_date[0]);
                        $("#address_client").text(registration.client.address);
                        $("#tel_client").text(registration.client.tel);
                        $("#city_client").text(registration.client.city);
                        $("#client_type").text(registration.client.nature);
                        $("#id_num_client").text(registration.client.num_id);
                        $("#id_type strong").text(registration.client.type_id);
                        $("#imei_device").text(registration.smartphone.imei);
                        $("#brand_device").text(registration.smartphone.model.brand.name);
                        $("#model_device").text(registration.smartphone.model.name);
                        $("#device_price").text(registration.smartphone.model.price_ttc);
                        $("#guarantee_device").text(guarantee);
                        $("#data_flow_date").text(data_flow[0]);
                        $("#agency_reg").text(agency.full_name);
                        $("#total_price_reg").text(registration.total_ttc);
                        $("#consulted_reg").attr('data-id', ID);
                    }
                });
            });
        }

        initDataTable();

        $('#extensions').on('change', function(){
            var extension = $(this).val();
            var price_ttc = parseInt($("#price_ttc").val());
            
            if(extension == '110'){
                $('#surprime_ttc').val((price_ttc * 10)/100);
            }else if(extension == '111'){
                $('#surprime_ttc').val((price_ttc * 20)/100);
            }else{
                $('#surprime_ttc').val(0.00);
            }
        });

        $("#add_avenant").on("click", function(e){
            e.preventDefault();
            $.ajax({
                type:'POST',
                url: '/avenants',
                data: {extension_added: $('#extensions').val(), add_premium: $('#surprime_ttc').val(), registration_id: $('#registration_id').val()},
                dataType: 'json',
                success: function(response){
                    if (response.status == 200) {
                        swal({
                            title: 'Update réussi',
                            text: response.message,
                            icon: "success",
                        })
                        refreshDataTable();
                    }else{
                        swal({
                            title: "Echec d'update",
                            text: response.message,
                            icon: "error",
                        })
                    }
                }
            });
        });

        $("#consulted_reg").on("click", function(e) {
            var ID = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                url: '/check-status/'+ID,
                success: function() {
                    refreshDataTable();
                }
            });
        });

        $("#export").on("click", function(e) {
            var self = $(this);
            if (self.attr('canExport') == undefined) {
                e.preventDefault();
                $.ajax({
                    url: 'export-registrations',
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
                window.location = '/export-registrations';
            }
        })

        $("#print_reg").on("click", function(e) {
            e.preventDefault();
            var ID = $("#consulted_reg").attr('data-id');

            var req = new XMLHttpRequest();
            req.open("GET", "/registration/" + ID + "/edit", true);
            req.responseType = "blob";
            req.onreadystatechange = function () {
                if (req.readyState === 4 && req.status === 200) {

                    // test for IE

                    if (typeof window.navigator.msSaveBlob === 'function') {
                    window.navigator.msSaveBlob(req.response, new Date().getTime() + "_Liste_des_souscriptions.xlsx.pdf");
                    } else {
                    var blob = req.response;
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = new Date().getTime() + "_Liste_des_souscriptions.xlsx.pdf";

                    // append the link to the document body

                    document.body.appendChild(link);

                    link.click();
                    link.remove();
                    }
                }
            };
            req.send();
        });
    } );
</script>
@endsection