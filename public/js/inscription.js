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
                response( $.ui.autocomplete.filter(jsonData, $( "#get_imei" ).val()) );
            }
        } );
        },
        select: function( event, ui ) {
            $.ajax({
                url: "/getSmartphoneByImei/"+ui.item.value,
                dataType: 'json',
                success: function( data ){
                    console.log(data);
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
        var invalids= $(hash).find('input,select, textarea').filter(function(i,el){return !el.checkValidity() }).css('border-color', 'red').focus()
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
    });
  
    $(".next-step").click(function(e) {
      var $active = $('.nav-pills li a.active');
      nextTab($active);
    });
  
    function nextTab(elem) {
      elem.parent().next().removeClass('disabled').find('a.nav-link').click();
    }
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

