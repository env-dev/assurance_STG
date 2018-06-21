var url_agency = 'agency'
function agenceInputMasks(){

    $('.phone').mask("00-00-00-00-00", {
        placeholder: "__-__-__-__-__"
    });
}

function getAgency(){
    $.ajax({
        type:'GET',
        url:url_agency,
        dataType: 'json',
        success: function(data){
            var rows = '';
            $.each(data,function(i,agence){
                rows += '\
                <tr>\
                    <td>'+agence.name+'</td>\
                    <td>'+agence.full_name+'</td>\
                    <td>\
                    <button type="button" class="btn btn-danger delete-agency" data-id="'+agence.id+'" title="Supprimer"><i class="fa fa-times"></i></button>\
                    <button type="button" class="btn btn-info update-agency" data-id="'+agence.id+'" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>\
                    <button type="button" class="btn btn-warning info-agency" data-id="'+agence.id+'" title="info">&nbsp;<i class="fa fa-info"></i>&nbsp;</i></button>\
                    </td>\
                </tr>\
                ';
            });
            $('#agency-table tbody').html(rows);
        },
        error: function(erros){
            errorMessages(errors);
        }
    });
}

function deleteOperation(url,confirmMsg='',successMsg=''){
    swal({
        title: "Êtes-vous sûr?",
        text: confirmMsg,
        icon: "warning",
        buttons:  ["Annuler", true],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type:'DELETE',
                url: url,
                dataType: 'json',
                success: function (data) {
                    swalSuccess('',successMsg);
                    initialize();
                },
                error: function (data) {
                    errorMessages(data);
                }
            });
          
        }
    });
}
 
function swalError(title='',text=''){
     swal({
         title: title,
         text: text,
         icon: "error",
     })
 }
function swalSuccess(title='',text=''){
     swal({
         title: title,
         text: text,
         icon: "success",
     })
}

function errorMessages(data){
    var errors="";
    $.each(data.responseJSON.errors, function(i,error){
        errors+= i + ": " + error[0] + "\n";
    });
    swalError("Invalid Data",errors + "\n ------- \n" + data.responseJSON.message);
}


$(function(){
    // INIT
    $("select").select2();
    agenceInputMasks()

    // View Agency's Information
    $('body').on('click','.info-agency',function(){
        var table = $('#agency-info-modal tbody');
        var id = $(this).data('id');
        
        $.ajax({
            type:'GET',
            url:'agency/'+id,
            dataType: 'json',
            success: function (agence) {
                table.html('');
                $('.updateModalAgencyInfo').modal('toggle');
                var rows = '<tr>\
                    <td>Nom D\'agence</td>\
                    <td>'+agence.name+'</td>\
                </tr>\
                <tr>\
                    <td>Nom Complet</td>\
                    <td>'+agence.full_name+'</td>\
                </tr>\
                <tr>\
                    <td>Reference</td>\
                    <td>'+agence.reference+'</td>\
                </tr>\
                <tr>\
                    <td>Telephone</td>\
                    <td>'+agence.phone+'</td>\
                </tr>\
                <tr>\
                    <td>Email</td>\
                    <td>'+agence.email+'</td>\
                </tr>\
                <tr>\
                    <td>address</td>\
                    <td>'+agence.address+'</td>\
                </tr>\
                <tr>\
                    <td>Ville</td>\
                    <td>'+agence.city.name+'</td>\
                </tr>';
                
                table.html(rows);
            },
            error: function (errors) {
                errorMessages(errors);
            }
        });
    });


    // add New Agency
    $('form#insert-agence-frm').submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type:'POST',
            url:url_agency,
            dataType: 'json',
            data: formData,
            success: function (data) {
                swalSuccess('','Inséré avec succès');
                $('form :input').val('');
                getAgency();
            },
            error: function(errors){
                errorMessages(errors);
            }
        });
    });

    // update Agency
    $('body').on('click','.update-agency',function(){
        var id = $(this).data('id');
        $.ajax({
            type:'GET',
            url:url_agency+'/'+id,
            dataType: 'json',
            success: function (agence) {

                $("#agence_name_modal").val(agence.name);
                $("#agence_fullname_modal").val(agence.full_name);
                $("#agence_reference_modal").val(agence.reference);
                $("#agence_tel_modal" ).val(agence.phone);
                $("#agence_email_modal").val(agence.email);
                $("#agence_address_modal").val(agence.address);
                $("#agence_city_modal").val(agence.city_id).trigger('change');
                $('.updateModalAgency').modal('toggle');

                $('.update-data').unbind('click').click(function(e){
                    e.preventDefault();
                    var formData = $('form#update-agence-frm').serialize();
                    $.ajax({
                        type:'PUT',
                        url:'agency/'+id,
                        dataType: 'json',
                        data: formData,
                        success: function (data) {
                            swalSuccess('','Mis à jour avec succés');
                            getAgency();
                        },
                        error: function(errors){
                            errorMessages(errors);
                        }
                    });
                });
            },
            error: function (errors) {
                errorMessages(errors);
            }
        });
    });

    // delete Agency

    $('body').on('click','.delete-agency',function(){
        var id = $(this).data('id');
        var url = url_agency+'/'+id;
        var msg = "Once deleted, you will not be able to recover it!";
        deleteOperation(url,'',"Supprimé avec succès");
        getAgency();
    });


    
});