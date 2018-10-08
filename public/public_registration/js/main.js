
$(document).ready(function(){
	function disableLoading(element,html='<img src="/public_registration/images/loading.svg" style="width:100px; height:100%;"/>'){
        element.html(html);
        element.prop('disabled',true);
    }
    function ableLoading(element, html='Inscrire'){
        element.html(html);
        element.prop('disabled',false);
    }

	$('input[name="date_flow"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		locale: {
		  format: 'YYYY-MM-DD'
		}
	});
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
    
    /**
     * Alert Variable
     */

    var thisAlert;


     /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var mainInput = $('.validate-form .validate-input .input100');
    var modalInput = $('.validate-form-modal .validate-input .input100');
   

    /**
     * Checking IMEIS Phone
     */
    var imei1,imei2,status;
    $('.validate-form').on('submit',function(e){
        e.preventDefault();
        disableLoading($('#btn-imei'));
        var c = check(mainInput);
        if(c){
            imei1 = $('#imei1').val();
            imei2 = $('#imei2').val();

            $.ajax({
                url:'/check-imeis',
                data:{imei1:imei1, imei2:imei2},
                success: function(info){
                    status = info.status;
                    if(info.status){
                        if(info.registred){
                            swal({
                                title: 'Félicitations',
                                text: 'Votre téléphone est enregistré.',
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: "Merci",
                                        value: true,
                                        visible: true,
                                        className:"btn-swal-success",
                                        closeModal: true,
                                    }
                                }
                            })
                        }else{
                            swal({
                                title: "Votre téléphone n'est pas enregistré",
                                text: "S'il vous plaît de l'enregistrer.",
                                icon: "error",
                                buttons: {
                                    cancel: {
                                        text: "Anuller",
                                        value: false,
                                        visible: true,
                                        className:"btn-swal-danger",
                                        closeModal: true,
                                    },
                                    confirm: {
                                        text: "inscrire",
                                        value: true,
                                        visible: true,
                                        className:"btn-swal-success",
                                        closeModal: true
                                  }
                                },
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then((register) => {
                                if (register) {
                                    $('#imei').val(imei1);
                                    $('.md-trigger').click();
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
					ableLoading($('#btn-imei'),'Valider');
                },
                error: function(error){
					ableLoading($('#btn-imei'),'Valider');
                    console.log(error);
                },
            });
        }else{
            //swal("Erreur", "Please Fill the Fields correctely", "error");
        }
        return c;
    });

    $('.validate-form-modal').on('submit',function(e){
        e.preventDefault();
        e.stopPropagation();
        disableLoading($('.register-form-btn'));

        var formData = $(this).serialize();
        console.log(formData);
        var cm = check(modalInput,true);
        if(cm){

            $.ajax({
                type:'POST',
                url:'/public-registration',
                dataType: 'json',
                data:formData,          
                success: function(response){
                    if (response.code == 1) {
                        swal({
                            title: 'Félicitation',
                            text: 'Votre souscription est effectué.',
                            icon: 'success'
                        }).then((ok) => {
                            if (ok) {
                                window.location = '/public-registration';
                            }
                        });                            
                    }else{
                        swal({
                            title: 'Ooops!!',
                            text: 'Une erreur est survenu, reéssayez svp.',
                            icon: 'error'
                        })
                    }

                    ableLoading($('.register-form-btn'));
                },
                error: function(response){
                    console.log(response);
                    var errors = "";
                    if (response.status == 404) {
                        errors = response.responseJSON.message;
                    } else if (response.status == 422) {
                        $.each(response.responseJSON.errors, function (field, error) {
                            errors += "- " + error[0] + "\n";
                        });
                    } else if (response.status == 412) {
                        errors = response.responseJSON.message;
                    } else if (response.status == 500) {
                        errors = "Message: " + response.responseJSON.message +
                            "\nFile: " + response.responseJSON.file.split('\\').slice(-1)[0] + ":" + response.responseJSON.line;
                    }
                    swal("Error", errors, "error");
                    ableLoading($('.register-form-btn'));
                }
            });          
        }
        ableLoading($('.register-form-btn'));
        return false;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidateModal(this);
        });
    });


    /**
     * 
     * Validation Functions
     *  
     */
    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
				console.log('maaail')
                return false;
            }
        }
        // else if(isNaN($(input).val())){
            // return false
        // }
        else {
			
            if($(input).val().trim() == ''){
				console.log('triiiim')
                return false;
            }
        }
		return true;
    }

    function showValidate(input) {
        thisAlert = $(input).parent();    
        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        thisAlert = $(input).parent();
        $(thisAlert).removeClass('alert-validate');
    }

    function showValidateModal(input) {
        showValidate(input);
        $(thisAlert).addClass('alert-validate-modal');
    }

    function hideValidateModal(input) {
        hideValidate(input);
        $(thisAlert).removeClass('alert-validate-modal');
    }

    function check(input, onModal=false){
        var check = true;
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                if(onModal) showValidateModal(input[i]);
                else showValidate(input[i]); 
                check=false;
            }
        }
        return check;
    }	
});





