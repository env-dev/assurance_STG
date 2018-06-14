function agenceInputMasks(){

    $('.phone').mask("00-00-00-00-00", {
        placeholder: "__-__-__-__-__"
    });
}

function getAgency(){
    $.ajax({
        type:'GET',
        url:'agency',
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
        title: "Are you sure?",
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


    // add New Agency
    $('form#insert-agence-frm').submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type:'POST',
            url:'agency',
            dataType: 'json',
            data: formData,
            success: function (data) {
                swalSuccess('','Agency Inserted successfully');
                $('form :input').val('');
                getAgency();
            },
            error: function(errors){
                errorMessages(errors);
            }
        });
    });

    // update Agency


    // delete Agency

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
                    <td>Tanger</td>\
                </tr>';
                
                table.html(rows);
            },
            error: function (errors) {
                errorMessages(errors);
            }
        });
    });
});