@extends('layout.main')
@section('title','Statistics Appareils')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Statistics Appareils
            </div>
            <div class="card-body">
                <div class="table-responsive table--no-card">
                    <table id="phones-status" class="table table-borderless table-striped table-earning text-center">
                        <thead>
                            <tr><th>IMEI</th>
                            <th>Model</th>
                            <th>statut</th>
                            <th>Details</th>
                           </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach($smartphones as $smartphone)
                            <tr>
                                <td>{{$smartphone->imei}}</td>
                                <td>{{$smartphone->model->name}}</td>
                                <td>
                                    @if($smartphone->status == 1)
                                    <span class="badge badge-pill badge-dark">STG Stock</span>
                                    @elseif($smartphone->status == 2)
                                    <span class="badge badge-pill badge-info">Agency Stock</span>
                                    @else
                                    <span class="badge badge-pill badge-success">Selled</span>
                                    @endif
                                </td>
                                <td>
                                    @if($smartphone->status == 2)
                                    <button class="btn btn-outline-info agence" data-id="{{$smartphone->id}}"  title="Info">&nbsp;<i class="fas fa-info"></i>&nbsp;</button>
                                    @elseif($smartphone->status == 3)
                                    <button class="btn btn-outline-success client" data-id="{{$smartphone->id}}"  title="Info">&nbsp;<i class="fas fa-info"></i>&nbsp;</button>
                                    @else
                                        No Infos
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody> --}}
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
var lookingFor;
var idSmartphone;
var details;

function send(){
    $.ajax({
        type:'GET',
        url:'statusInfo',
        dataType: 'json',
        async:false,
        data: {lookingFor: lookingFor, idSmartphone:idSmartphone},
        success: function (response) {
            console.log(response);
           details = response;
        },
        error: function(error){
            console.log(error);
        }
    });
}

$(function(){
    //$('#phones-status').DataTable();

    $('#phones-status').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": '/status',
        columns: [
              { data: "imei",name: "imei" },
              { data: "model.name",name: "model.name" },
              { data: "status",name: "status" },
              { data: "actions", name: "actions", orderable: false, searchable: false },
          ]
    });

    $('body').on('click','.agence',function(){
        lookingFor = 'agence';
        idSmartphone = $(this).data('id');
        send();
        var content = 
        '<table class="table table-hover table-bordered table-striped">'+
        
        '<tr class="text-center"> <th colspan="2">Agence</th> </tr>'+
        
        '<tr> <th>Reference</th> <td>'+ details.reference +'</td> </tr>'+

        '<tr><th>Nom</th> <td>'+ details.full_name +'</td> </tr>'+

        '<tr> <th>Nom Agence</th> <td>'+ details.name +'</td> </tr>'+

        '<tr><th>Ville</th> <td>'+ details.city.name +'</td></tr>'+

        '</table>';
        $('#details').html(content);
        $('.updateModalSmartphoneDetails').modal('toggle');
            
    });

    $('body').on('click','.client',function(){
        lookingFor = 'client';
        idSmartphone = $(this).data('id');
        send();
        var content = 
        '<div class="row"><div class="col-md-6">'+

        '<table class="table  table-hover table-bordered table-striped">'+
        
        '<tr class="text-center"> <th colspan="2">Agence</th> </tr>'+

        '<tr> <th>Reference</th> <td>'+ details.agence.reference +'</td> </tr>'+

        '<tr><th>Nom</th> <td>'+ details.agence.full_name +'</td> </tr>'+

        '<tr> <th>Nom Agence</th> <td>'+ details.agence.name +'</td> </tr>'+

        '<tr><th>Ville</th> <td>'+ details.agence.city.name +'</td></tr>'+

        '</table></div>'+
        '<div class="col-md-6"><table class="table  table-hover table-bordered table-striped">'+

        '<tr class="text-center"> <th colspan="2">Client</th> </tr>'+

        '<tr> <td>Full Name</td> <td>'+ details.client.first_name + ' ' + details.client.last_name  +'</td> </tr>'+

        '<tr><td>Nature</td> <td>'+ details.client.nature +'</td> </tr>'+

        '<tr> <td>Email</td> <td>'+ details.client.email +'</td> </tr>'+
        
        '<tr> <td>Telephone</td> <td>'+ details.client.tel +'</td> </tr>'+

        '</table></div></div>';

        $('#details').html(content);
        $('.updateModalSmartphoneDetails').modal('toggle');
    });
});
  
</script>
@endsection