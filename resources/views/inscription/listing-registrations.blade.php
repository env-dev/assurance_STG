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
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {

        function getRegistration() 
        {
            $(".addAvenant").on("click", function(){
                    var ID = $(this).attr('data-id');
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

        $("#registration-list").DataTable({
            processing: true,
            serverSide: true,
            initComplete: function( settings, json ) {
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