// Global Variables
/// ---- Routes ---- /// 
var url_smartphones = 'smartphones';
var url_models = 'models';
var url_brands = 'brands';

/// ---- DataTables ---- /// 
var brands_table;
var models_table;
var smartphones_table;


function initialize(){
    getBrands();
    getModels();
    getSmartphones();
}

//#region Functions
// This Part it should be in main.js
// For global functions
function getBrands(){
    if(brands_table)
         brands_table.destroy();
 
     brands_table =  $('#brands-table').DataTable( {
         processing: true,
         serverSide: true,
          ajax: url_brands,
          columns: [
            { data: "DT_Row_Index", name: "id" },
            { data: "name",name: "name" },
            { data: "actions", name: "actions", orderable: false, searchable: false },
          ]
     });
 }
 
 
 function getModels(){
     if(models_table)
         models_table.destroy();
 
     models_table =  $('#models-table').DataTable( {
         processing: true,
         serverSide: true,
          ajax: url_models,
          columns: [
            { data: "DT_Row_Index", name: "id" },
            { data: "brand.name", name: "brand.name" },
            { data: "name", name: "name" },
            { data: "actions", name: "actions", orderable: false, searchable: false },
          ]
     });
 }
 
 function getSmartphones(){
     if(smartphones_table)
         smartphones_table.destroy();
 
     smartphones_table =  $('#smartphones-table').DataTable( {
         processing: true,
         serverSide: true,
          ajax: url_smartphones,
          columns: [
              { data: "DT_Row_Index", name: "id" },
              { data: "model.brand.name",name: "model.brand.name" },
              { data: "model.name",name: "model.name" },
              { data: "imei",name: "imei" },
              { data: "actions", name: "actions", orderable: false, searchable: false },
          ]
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

function inputValidate(input,type)
{
    if(type == "numeric"){
        return emptyInput(input) && checkIsNumber(input);
    }
    if(type == "text"){
        return emptyInput(input)
    }
}
function checkIsNumber(input){
    if(isNaN(input.val())){
        input.addClass('is-invalid');
        input.focus();
        return false;
    }
    input.removeClass('is-invalid');
    return true;
}
function emptyInput(input){
    if(input.val() == ''){
        input.addClass('is-invalid');
        input.focus();
        return false;
    }
    input.removeClass('is-invalid');
    return true;
}

function inputsValidation(inputs){
    var valid = true;
    $.each(inputs,function(i,input){
        if(!inputValidate(input.field,input.type)){
            valid = false;
            return;
        }
    });
    return valid;
}
//#endregion



initialize()


//#region Insert Section
/**
 ===============================================================
 * 
 *<===================> Insert Section <=======================>
 * 
 ===============================================================
 */



/**
 ************************************* 
 * Insert New Marque
 ************************************* 
*/
$('#insert-marque').click(function(e){
    
    e.preventDefault();
    
    var marque_field = $('#marque_name_add');
    var validation = [
        {'field': marque_field, 'type': 'text'},
    ];
    if(!inputsValidation(validation)) return;

    $.ajax({
        type:'POST',
        data: {name: marque_field.val()},
        url: url_brands,
        dataType: 'json',
        success: function (data) {
            swalSuccess('','Inserted Successfully');
            $('form :input').val('');
            getBrands();
        },
        error: function (data) {
            errorMessages(data)
        }
    });
});

/**
 ************************************* 
 * Insert New Model
 ************************************* 
*/

$('#insert-model').click(function(e){
    e.preventDefault();
    var model_field = $('#model_name_add');
    var model_marque_add = $('#model_marque_add');
    var model_price_add = $('#model_price_add');
    var validation = [
        {'field': model_field, 'type': 'text'},
        {'field': model_price_add, 'type': 'numeric'},
    ];

    if(inputsValidation(validation)){
        $.ajax({
            type:'POST',
            data: {
                marque: model_marque_add.val(),
                name: model_field.val(),
                price_ttc: model_price_add.val()
            },
            url: url_models,
            dataType: 'json',
            success: function (data) {
               swalSuccess('','Model is inserted Successfully');
               getModels();
               $('form :input').val('');
            },
            error: function (data) {
                errorMessages(data);
            }
        });
    }
});

/**
 ************************************* 
 * Insert New Appareil
 ************************************* 
*/

$('#insert-appareil').click(function(e){
    e.preventDefault();
    var appareil_model_field = $('#appareil_model_add');
    var imei_field = $('#imei_add');
    
    var validation = [
        {'field': appareil_model_field, 'type': 'text'},
        {'field': imei_field, 'type': 'numeric'},
    ]
    if(!inputsValidation(validation)) return;
    $.ajax({
        type:'POST',
        data: {
            brand_model_id: appareil_model_field.val(),
            imei: imei_field.val()
        },
        url: url_smartphones,
        dataType: 'json',
        success: function (data) {
            swalSuccess('','Smartphone is inserted Successfully');
               getSmartphones();
               $('input').val('');
        },
        error: function (data) {
            errorMessages(data);
        }
    });
});

//#endregion

//#region Update Section

/**
 ===============================================================
 * 
 *<===================> Update Section <=======================>
 * 
 ===============================================================
 */



/**
 ************************************* 
 * Update Marque
 ************************************* 
*/
$('body').on('click','.update-marque',function(){
    var marque_field = $('#marque_name_modal');
    
    // Get Marque Information
    var id = $(this).data('id');
     $.get(url_brands+'/'+id+'/edit', function (data) {
        // get field values
        marque_field.val(data.name);
    });
   
    // Show Modal
    $('.updateModalMarque').modal('toggle');
    $('.update-data').unbind('click').click(function(){
        //Validation
        var validation = [
            {'field': marque_field, 'type': 'text'},
        ];
    
        if(!inputsValidation(validation)) return;

        // Send Updated Data
        $.ajax({
            type:'PUT',
            data: {name: marque_field.val()},
            url: url_brands+'/'+id,
            dataType: 'json',
            success: function (data) {
                swalSuccess('','Updated Successfully');
                getBrands();
            },
            error: function (data) {
                errorMessages(data);
            }
        });
    });
});


/**
 ************************************* 
 * Update Model
 ************************************* 
*/
$('body').on('click','.update-model',function(){
    var model_marque_field = $('#model_marque_modal');
    var model_name_field = $('#model_name_modal');
    var model_price_model = $('#model_price_model');
    
   
    // Get model Information
    var id = $(this).data('id');
    $.get(url_models+'/'+id+'/edit', function (data) {
        // get field values
        model_marque_field.val(data.brand_id)
        model_name_field.val(data.name);
        model_price_model.val(data.price_ttc);
    });

    // Show Modal
    $('.updateModalModel').modal('toggle');
    $('.update-data').unbind('click').click(function(e){
        event.stopPropagation();
        //Validation
        var validation = [
            {'field': model_name_field, 'type': 'text'},
            {'field': model_price_model, 'type': 'numeric'},
        ];
        if(!inputsValidation(validation)) return;
            // Send Updated Data
            $.ajax({
                type:'PUT',
                data: {
                    name: model_name_field.val(),
                    marque: model_marque_field.val(),
                    price_ttc: model_price_model.val()
                },
                url: url_models+'/'+id,
                dataType: 'json',
                success: function (data) {
                    swalSuccess('','Model Updated successfully')
                    getModels();
                },
                error: function (data) {
                    errorMessages(data);
                }
            });
            
    });
});

/**
 ************************************* 
 * Update Appareil
 ************************************* 
*/
$('body').on('click','.update-appareil',function(){
    var imei_field = $('#imei_modal');
    var appareil_model_field = $('#appareil_model_modal');
    
    // Get appareil Information
    var id = $(this).data('id');
      $.get(url_smartphones+'/'+id+'/edit', function (data) {
        // get field values
        imei_field.val(data.imei);
        appareil_model_field.val(data.brand_model_id);
    });
     
    // Show Modal
    $('.updateModalAppareil').modal('toggle');
    $('.update-data').unbind('click').click(function(){
        // Send Updated Data
        $.ajax({
            type:'PUT',
            data: {
                imei: imei_field.val(),
                brand_model_id: appareil_model_field.val()
            },
            url: url_smartphones+'/'+id,
            dataType: 'json',
            success: function (data) {
                swalSuccess('','Smartphone Updated successfully')
                getSmartphones();
            },
            error: function (data) {
                errorMessages(data);
            }
        });
    });
});
//#endregion

//#region Delete Section

/**
 ===============================================================
 * 
 *<===================> Delete Section <=======================>
 * 
 ===============================================================
 */



/**
 ************************************* 
 * Delete Marque
 ************************************* 

*/

$('body').on('click','.delete-marque',function(){

    var id = $(this).data('id');
    var url = url_brands+'/'+id;
    var msg = "Once deleted, you will remove all Phones are related to this brand!";
    deleteOperation(url,'',"Brand is deleted successfully");
    getBrands();
    
});

/**
 ************************************* 
 * Delete Model
 ************************************* 
*/

$('body').on('click','.delete-model',function(){
    var id = $(this).data('id');
    var url = url_models+'/'+id;
    var msg = "Once deleted, you will remove all Phones are related to this brand!";
    deleteOperation(url,'',"Model is deleted successfully");
    getModels();
    
});

/**
 ************************************* 
 * Delete Appareil
 ************************************* 
*/

$('body').on('click','.delete-appareil',function(){
    var id = $(this).data('id');
    var url = url_smartphones+'/'+id;
    var msg = "Once deleted, you will not be able to recover it!";
    deleteOperation(url,'',"Smartphone is deleted successfully");
    getSmartphones();
    
});

//#endregion