@extends('layout.main')
@section('title','Gestion de Stock')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Gestion du Stock
            </div>
            <div class="card-body">
                <div class="table-responsive table--no-card">
                    <table id="phones-in-stock" class="table table-borderless table-striped table-earning text-center">
                        <thead>
                            <th>Reference</th>
                            <th>Responsable</th>
                            <th>Nom D'agence</th>
                            <th>Joined on</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($agencies as $agency)
                            <tr>
                                <td>{{$agency->reference}}</td>
                                <td>{{$agency->full_name}}</td>
                                <td>{{$agency->name}}</td>
                                <td>{{ $agency->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <button class="btn btn-outline-danger delete" data-id="{{$agency->id}}" data-toggle="tooltip" data-placement="top" title="Remove smartphone from agency stock"><i class="fas fa-times"></i></button>
                                    <button class="btn btn-outline-info info" data-id="{{$agency->id}}" data-toggle="tooltip" data-placement="top" title="Commandes">&nbsp;<i class="fas fa-info"></i>&nbsp;</button>
                                    <button class="btn btn-outline-secondary insert" data-id="{{$agency->id}}"  data-toggle="tooltip" data-placement="top" title="Insert New Or Bulk Phone to Agency"><i class="fas fa-mobile-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('stock/modal')
@endsection
@section('js')
<script>
    
var agence;
var imei = $('#imei_modal');
var imeiList = $('#imei_list_modal');
var file = $('#smart_file');
var requestType = 'POST';


function clearFields(){
    imei.val("").trigger("change");
    imeiList.val('');
    file.val('');
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

function swalInfo(title='',text=''){
     swal({
         title: title,
         text: text,
         icon: "info",
     })
}

function errorMessages(data){
    var errors="";
    $.each(data.responseJSON.errors, function(i,error){
        errors+= i + ": " + error[0] + "\n";
    });
    swalError("Invalid Data",errors + "\n ------- \n" + data.responseJSON.message);
}

function send(data){
    $.ajax({
        type:requestType,
        url:'stock',
        dataType: 'json',
        data: data,
        success: function (response) {
            clearFields();
            swalSuccess('','Inséré avec succès');
            if(response[1] && response[1].length > 0){
                var errors='';
                for(let i=0; i<response[1].length ; i++){
                    errors+= '<li> ' + response[1][i] + ' </li>'
                }
                $('.response').html('<div class="alert alert-warning"> <b>Remarques:</b> <br>' + errors + '</div>');
            }
        },
        error: function(error){
            console.log(error);
            errorMessages(error);
        }
    });
}

$(function(){
    $('#phones-in-stock').dataTable();
    $('.insert').click(function(){
        agence = $(this).data('id');
        $('.submit-action').html('insert')
        $('.submit-action').removeClass('btn-danger')
        $('.submit-action').addClass('btn-primary')
        $('.updateModalBulkInsertion').modal('toggle');
        requestType = 'post';
    });
    
    $('.delete').click(function(){
        agence = $(this).data('id');
        $('.submit-action').html('delete')
        $('.submit-action').removeClass('btn-primary')
        $('.submit-action').addClass('btn-danger')
        $('.updateModalBulkInsertion').modal('toggle');
        requestType = 'delete';
    });

    $('.info').click(function(){
        agence = $(this).data('id');
        $.ajax({
            url:'stock/get-agence-info/'+agence,
            dataType:'json',
            success:function(commands){
                if(commands.length>0){
                    var line='';
                    $.each(commands, function(k,command){
                        line+= '<tr>'+
                            '<td>'+ (k+1) +'</td>'+
                            '<td>'+command.ref_cmd+'</td>'+
                            '<td>'+command.count+'</td>'+
                            '<td>'+command.date+'</td>'+
                            '</tr>';
                    });
                        
                    $('#table-cmd tbody').html(line);
                        
                    $('.updateModalCommandDetails').modal('toggle');
                }else{
                    swalInfo('Aucune Commande');
                }
            },
            error:function(error){
                console.log(error);
            }
        });
        $
    });



    $( "#imei_modal" ).select2({
        multiple:true,
        ajax:{
            url: 'stock/get-imei',
            dataType: "json",
            data: function (params) {
                return {
                    q: $.trim(params.term),
                    action: requestType,
                    agence: agence
                };
            },
            processResults: function (data) {
                return {
                results:  $.map(data, function (item) {
                    return {
                            text: item.imei,
                            id: item.id
                        }
                    })
                };
           },
           cache: true
        }
    });


    $('form#classic-form').submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize();
        formData+="&agence="+agence;
        send(formData);
    });
    $('form#classic2-form').submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        formData+="&agence="+agence;
        send(formData);
    });

    $('#bulk-form').submit(function(e){
        e.preventDefault();
        $('.response').html('');
        var btn = $('#btn-import');
        var file_btn = $('#smart_file');
        var data =  new FormData($(this)[0]);
            data.append('agence',agence);
             if(requestType=='delete')
                 data.append('type','file_delete');

        btn.html('<i class="fas fa-spinner fa-spin"></i>');
        btn.prop("disabled",true);
        file_btn.prop("disabled",true);
        $.ajax({
            type:'POST',
            url:'stock',
            data: data,
            contentType:false,
            processData:false,
            success: function(response){
                btn.prop("disabled",false);
                btn.html('Importer');
                file_btn.prop("disabled",false);
                swalSuccess('','Inséré avec succès');
                if(response[1] && response[1].length > 0){
                    var errors='';
                    for(let i=0; i<response[1].length ; i++){
                        errors+= '<li> ' + response[1][i] + ' </li>'
                    }
                    $('.response').html('<div class="alert alert-warning"> <b>Remarques:</b> <br>' + errors + '</div>');
                }
                clearFields();
            },
            error: function(error){
                btn.prop("disabled",false);
                btn.html('Importer');
                file_btn.prop("disabled",false);
            }
        });
    });

    $('.updateModalBulkInsertion').on('hidden.bs.modal', function (e) {
        clearFields();
        $('.response').html('');
    })
});
</script>
@endsection