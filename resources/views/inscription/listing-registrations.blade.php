@extends('layout.main')

@section('css')
@endsection

@section('title','Nouvelles adhésions')

@section('content')
<div class="col-4 offset-md-4">
    <h2>La liste des Souscriptions</h2>
</div>
<div class="col-md-12">
    <a class="btn btn-primary m-l-10 m-b-10" href="{{ url('registration') }}" id="new_memberships" >Ajouter une souscription
    </a>
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
                            <label class="col-lg-6" id="id_type"></label>
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
                    <button type="button" class="btn btn-primary" id="confirmRegistration" data-dismiss="modal">OK</button>
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
                                extensions += '<option value="110">F2</option>';
                                extensions += '<option value="111">F3</option>';
                            }else if (registration.guarantee == 110){
                                extensions += '<option value="111">F3</option>';
                            }              
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
                        var birth_date = data.client.birth_date.split(' ');
                        var data_flow = data.data_flow.split(' ');
                        
                        if (data.guarantee == 110) {
                            guarantee = 'F2';
                        }else if(data.guarantee == 111){
                            guarantee = 'F3';
                        }
                        // fill the model with registration data
                        $("#full_name_client").text(data.client.first_name + ' ' +data.client.last_name);
                        $("#email_client").text(data.client.email);
                        $("#birthdate_client").text(birth_date[0]);
                        $("#address_client").text(data.client.address);
                        $("#tel_client").text(data.client.tel);
                        $("#city_client").text(data.client.city);
                        $("#client_type").text(data.client.nature);
                        $("#id_num_client").text(data.client.num_id);
                        $("#id_type").text(data.client.type_id);
                        $("#imei_device").text(data.smartphone.imei);
                        $("#brand_device").text(data.smartphone.model.brand.name);
                        $("#model_device").text(data.smartphone.model.name);
                        $("#device_price").text(data.smartphone.model.price_ttc);
                        $("#guarantee_device").text(guarantee);
                        $("#data_flow_date").text(data_flow[0]);
                        // $("#agency_reg").text(agency);
                        $("#total_price_reg").text(data.total_ttc);
                    }
                });
            });
        }

        $("#registration-list").DataTable({
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
    } );
</script>
@endsection