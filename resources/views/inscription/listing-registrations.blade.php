@extends('layout.main')

@section('css')
<style>
    .invalid {
        border-color: red;
    }
</style>
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
                    <th>IMEI</th>
                    <th>CIN/RC</th>
                    <th>Date de flux de données</th>
                    <th>Créer le</th>
                    <th>Validité</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div>@include('inscription.inc.consult-reg-modal')</div>
<div>@include('inscription.inc.add-sinister-modal')</div>
<div>@include('inscription.inc.add-avenant-modal')</div>
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
                    clearModal();
                },
                language: {
                    url: "{{ asset('/js/lang/dataTables.french.json') }}"
                },
                ajax: "/getRegistrations",
                columns: [
                    { data: "mandat_num", name: "mandat_num", orderable: false},
                    { data: "smartphone.imei", name: "smartphone.imei", orderable: false, searchable: true },
                    { data: "client.num_id", name: "client.num_id", orderable: false, searchable: true },
                    { data: "data_flow",name: "data_flow" },
                    { data: "created_at", name: "created_at" },
                    { data: "validity", name: "validity"},
                    { data: "new", name: "new" },
                    { data: "edit", name: "edit", orderable: false, searchable: false },
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
                        success: function(data){
                            var registration = data.registration;
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

        function clearModal()
        {
            $(".add_sinister").on("click", function() {
                $('#add_sinister').find('input,select, textarea').removeClass('invalid');
                $('#place_sinister').val('');
                $('#cause_sinister').val('');
                $('#sinister_date').val('');
                $("#sinister_type").prop('selectedIndex','');

                $("#registration_id").attr('data-id', $(this).attr('data-id'));
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
        // Claim sinister
        $("#register_sinister").on("click", function(e) {
            
            var registration_id = $("#registration_id").attr('data-id');
            var date_sinister = $("#sinister_date").val();
            var place_sinister = $("#place_sinister").val();
            var cause_sinister = $("#cause_sinister").val();
            var type_sinister = $("#sinister_type").val();

            function divValid(hash) {
                var invalids = $(hash).find('input, select, textarea').filter(function(i,el){return !el.checkValidity() }).addClass('invalid');
                return invalids.length===0
            }
            if (!divValid('#add_sinister')) {
                return false;
            } 

            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type: "POST",
                url: 'sinisters',
                data: {
                    registration_id: registration_id,
                    date_sinister: date_sinister,
                    place_sinister: place_sinister,
                    cause_sinister: cause_sinister,
                    type_sinister: type_sinister,
                },
                success: function(registred) {
                    if (registred) {
                        swal({
                            title: 'Déclaration du sinistre',
                            text: 'Sinister est déclaré',
                            icon: "success",
                        })
                    }else{
                        swal({
                            title: 'Déclaration du sinistre',
                            text: 'Sinister  a echoué',
                            icon: "error",
                        })
                    }
                    refreshDataTable();
                },
                error: function(err) {
                    swal({
                            title: 'Déclaration du sinistre',
                            text: 'Sinister  a echoué',
                            icon: "error",
                        })
                    console.log(err.responseText);
                }
            });
        });
    } );
</script>
@endsection