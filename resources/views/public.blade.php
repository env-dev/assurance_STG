@include('layout.inc.header')
<!-- Page Wrapper-->
<div class="page-wrapper">
    <div class="page-container">
        <!-- MAIN CONTENT-->
        <div id="main" class="main-content" >
            
            <div class="row ">
                <div class="col-8 offset-md-1">
                    <div class="offset-md-4 mb-3">
                            <h2>Public Registration</h2>
                    </div>
                    <div class="card" id="imeiCard">
                        <div class="card-header bg-secondary text-center text-uppercase text-white">
                            Registring Validation 
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-md-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="imei1" class="control-label mb-1">IMEI 1:</label>
                                        <input id="imei1" name="imei1" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="imei2" class="control-label mb-1">IMEI 2:</label>
                                        <input id="imei2" name="imei2" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="validate" class="btn btn-secondary btn-block"><i class="far fa-check-circle"></i> Validate</button>
                        </div>
                    </div>
                    <div class="card" id="clientCard">
                        <div class="card-header bg-secondary text-center text-uppercase text-white">
                            Client Information 
                        </div>
                        <div class="card-body">
                            <form action="" id="client-info">
                                <div class="row">
                                    <input type="hidden" id="imei" name="imei" value="">
                                    <div class="col-6">
                                        <label for="x_card_code" class="control-label mb-1">Prénom</label>
                                        <div class="input-group">
                                            <input id="first_name" name="first_name" type="text" class="form-control cc-cvc" required>
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Nom</label>
                                            <input id="name" name="last_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="email-input" class=" form-control-label">Email</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="email" id="email" name="email" placeholder="Entrer Email" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="birthdate" class="control-label mb-1">Date de naissance</label>
                                        <div class="input-group">
                                            <div class="input-group date" id="birthdate" data-target-input="nearest">
                                                <input type="text" name="birth_date" id="birth_date" class="form-control datetimepicker-input" data-target="#birthdate" required/>
                                                <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">Adresse</label>
                                            <input id="address" name="address" type="text" class="form-control" required>
                                            <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">Tel</label>
                                            <input id="tel" name="tel" type="text" class="form-control tel" required>
                                            <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label for="city" class=" form-control-label">Ville</label>
                                            <input type="text" id="city" name="city" placeholder="Votre ville" class="form-control" required>
                                            
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label for="nature" class="form-control-label">Nature</label>
                                            <select name="nature" id="nature" class="form-control" required>
                                                <option value="">-----</option>
                                                <option value="Particulier">Particulier</option>
                                                <option value="Entreprise">Entreprise</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group type_id">
                                            <label for="id" class=" form-control-label">CIN</label>
                                            <input type="text" name="num_id" id="id" placeholder="Votre identifiant" class="form-control" required>
                                            <input type="hidden" name="type_id" id="type_id" value="CIN">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button id="validate" class="btn btn-secondary btn-block"><i class="far fa-check-circle"></i> Register</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->
</div>
    <!-- END Page Wrapper-->
@include('layout.inc.footer')
<script>
    $('#clientCard').hide();
    var imei1,$imei2,status;
    $(function(){
        $('#validate').click(function(){
            imei1 = $('#imei1').val();
            imei2 = $('#imei2').val();
            if(imei1 == '' || imei2 == ''){
                alert('Nah, is not gonna happen. Please Fill all the IMEI fields');
            }else{
                $.ajax({
                    url:'/check-imeis',
                    data:{imei1:imei1, imei2:imei2},
                    success: function(info){
                        console.log(info);
                        status = info.status;
                        if(info.status){
                            if(info.registred){
                                swal({
                                    title: 'Congrats',
                                    text: 'Your Phone is registred',
                                    icon: "success",
                                })
                            }else{
                                swal({
                                    title: 'Your Phone is not registred',
                                    text: 'Please fill you Information to complete your registration',
                                    icon: "error",
                                    buttons:  ["Cancel", "Register"],
                                }).then((register) => {
                                    if (register) {
                                        $('#imeiCard').hide();
                                        $('#clientCard').show();
                                        $('#imei').val(imei1);
                                    }
                                });
                            }
                        }else{
                            swal({
                                title: 'Error',
                                text: info.msg,
                                icon: "error",
                            });
                        }
                    },
                    error: function(error){
                        console.log(error);
                    },
                });
            }
        });


        // Client Regisration
        $('#register').click(function(){

        });

    });
</script>
