$.ajax({
    url:"agency",
    type:"GET",
    success: function(agencies){
        //console.log(agencies);
        $('#agencies').html('');
        var options='<option value="0"></option>';
        $.each(agencies, function(key,agence){
            console.log(options);
            options+='<option value="'+agence.id+'">'+agence.full_name+'</option>';
        });
        $('#agencies').html(options);
    }
})

// ---------- AutoComplite function
$( function() {

    $( "#get_imei" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
            url: "/get_imei",
            dataType: "json",
            success: function( data ) {
                var jsonData = [];
                $.map( data, function( val, i ) {
                    jsonData.push(val.imei);
                  });
                response( $.ui.autocomplete.filter(jsonData, $( "#get_imei" ).val()).slice(0, 10) );
            }
        } );
        },
        select: function( event, ui ) {
            $.ajax({
                url: "/getSmartphoneByImei/"+ui.item.value,
                dataType: 'json',
                success: function( data ){
                    $('#brandName').text(data.model.brand.name);
                    $('#modelName').text(data.model.name);
                    $('#smartphonePrice').text(data.model.price_ttc);
                    $('#total_ttc').val(data.model.price_ttc);
                }
            });
        }
    });
} );
// ------------ Validation form (Step by step)
$(function() {
    // navigation buttons
    function divValid(hash) {
        var invalids= $(hash).find('input,select, textarea').filter(function(i,el){return !el.checkValidity() }).css('border-color', 'red')
        return invalids.length===0
    }
  
    $('a.nav-link').on('show.bs.tab', function(e) {
      var $target = $(e.target);
      if (!divValid($('.nav-pills li a.active').prop('hash'))) {
          e.preventDefault();
        } 
        if ($target.parent().hasClass('disabled')) {
            e.preventDefault();
        }
        if ($target.text() == 'Appareil') {
            $($target.attr('href')).find('.next-step').attr('disabled', true);
        }
    });
  
    $(".next-step").click(function(e) {  
        e.preventDefault();
        var $active = $('.nav-pills li a.active');
        nextTab($active);
    });
  
    function nextTab(elem) {
      elem.parent().next().removeClass('disabled').find('a.nav-link').click();
    }

    $("#get_imei").on("blur", function() {
        var imei = $(this).val();
        var next_step = $($('.nav-pills li a.active').attr('href')).find('.next-step');
        $.ajax({
            url: 'get_imei/'+imei,
            success: function(response) {
                if (!jQuery.isEmptyObject(response)) {
                    next_step.attr('disabled', false);
                }else{
                    next_step.attr('disabled', true);
                    swal({
                            title: 'Erreur IMEI',
                            text: 'Cette IMEI n\'existe pas.',
                            icon: 'error'
                        })
                }
            },
            error: function(err) {
                console.log(err);
                return
            }
        })
    })
});

$(function(){
    $('#nature').on('change', function(){
        var nature = $(this).val();
        if(nature == 'Entreprise'){
            $('.type_id label').text('RC/Patente');
            $('#type_id').val('RC/Patente');
        }else{
            $('.type_id label').text('CIN');
            $('#type_id').val('CIN');
        }
    });
    $('#guarantee').on('change', function(){
        var guarantee = $(this).val();
        var price_ttc = parseInt($('#smartphonePrice').text());

        if (isNaN(price_ttc)) { return 0 }
        
        if(guarantee == '110'){
            $('#total_ttc').val(price_ttc + (price_ttc * 10)/100);
        }else if(guarantee == '111'){
            $('#total_ttc').val(price_ttc + (price_ttc * 20)/100);
        }else{
            $('#total_ttc').val(price_ttc);
        }
    });
});
$(function(){
    $( "#agency" ).autocomplete({
        source: function( request, response ) {
            $.ajax( {
                url: "/getAgencies",
                dataType: "json",
                success: function( data ) {
                    var jsonData = [];
                    $.map( data, function( val, i ) {
                        jsonData.push(val.full_name);
                    });
                    response( $.ui.autocomplete.filter(jsonData, $( "#agency" ).val()) );
                }
            } );
        },
        select: function( event, ui ) {
            $.ajax({
                url: "/getSmartphoneByImei/"+ui.item.value,
                dataType: 'json',
                success: function( data ){
                    $('#brandName').text(data.model.brand.name);
                    $('#modelName').text(data.model.name);
                    $('#smartphonePrice').text(data.model.price_ttc);
                    $('#total_ttc').val(data.model.price_ttc);
                }
            });
        }
    });

    $("#saveRegistration").on("click", function(e){
        e.preventDefault()
        function divValid(hash) {
            var invalids= $(hash).find('input,select, textarea').filter(function(i,el){return !el.checkValidity() }).css('border-color', 'red')
            return invalids.length===0
        }
        if (!divValid($('.nav-pills li a.active').prop('hash'))) {
            return false;
          } 
        // Infos client
        var name = $("#name").val();
        var first_name = $("#first_name").val();
        var email = $("#email").val();
        var birth_date = $("#birth_date").val();
        var address = $("#address").val();
        var tel = $("#tel").val();
        var city = $("#city").val();
        var nature = $("#nature").val();
        var id = $("#id").val();
        var type_id = $("#type_id").val();
        // Fin infos appareil
        var imei = $("#get_imei").val();
        var brandName = $("#brandName").text();
        var modelName = $("#modelName").text();
        var smartphonePrice = $("#smartphonePrice").text();
        // Fin infos souscription
        var guarantee = ($("#guarantee").val() == '100') ? 'F1' : 'F2';
        var date_flow_data = $("#flow_data").val();
        var agency = $("#agence_name").val();
        var total_ttc = $("#total_ttc").val();

        $("#full_name_client").text(name + ' ' +first_name);
        $("#email_client").text(email);
        $("#birthdate_client").text(birth_date);
        $("#address_client").text(address);
        $("#tel_client").text(tel);
        $("#city_client").text(city);
        $("#client_type").text(nature);
        $("#id_num_client").text(id);
        $("#id_type").text(type_id);
        $("#imei_device").text(imei);
        $("#brand_device").text(brandName);
        $("#model_device").text(modelName);
        $("#device_price").text(smartphonePrice);
        $("#guarantee_device").text(guarantee);
        $("#data_flow_date").text(date_flow_data);
        $("#agency_reg").text(agency);
        $("#total_price_reg").text(total_ttc);

    });

    $("#confirmRegistration").on("click", function(e){
        var req = new XMLHttpRequest();
        var myForm = document.getElementById('inscriptionForm');
        var formData = new FormData(myForm);
        
        req.open("POST", "/registration", true);
        req.responseType = "blob";
        req.onreadystatechange = function () {
            if (req.readyState === 4 && req.status === 200) {

                // test for IE

                if (typeof window.navigator.msSaveBlob === 'function') {
                window.navigator.msSaveBlob(req.response, new Date().getTime() + "Contrat_de_souscription.pdf");
                } else {
                var blob = req.response;
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = new Date().getTime() + "Contrat_de_souscription.pdf";

                // append the link to the document body

                document.body.appendChild(link);

                link.click();
                link.remove();
            }
            window.location = '/listing-registrations';
        }
    };
    req.send(formData);
        // jQuery("#inscriptionForm").submit();
    });

    $('.tel').mask("00-00-00-00-00", {
        placeholder: "__-__-__-__-__"
    });
});