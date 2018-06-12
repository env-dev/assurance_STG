// Global Variables
/// ---- Routes ---- /// 
var url_permissions = 'permissions';
var url_roles = 'roles';
var url_users = 'users';

/// ---- DataTables ---- /// 
var permissions_table;
var roles_table;
var users_table;


function initialize(){
    getPermissions()
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

//#region Functions
// This Part it should be in main.js
// For global functions
function getPermissions(){
    $.ajax({
        type:'GET',
        url: url_permissions,
        dataType: 'json',
        success: function (permissions) {
            let row =''
            $.each(permissions, function(index,permission){
                row += '\
                <tr>\
                    <td>'+(index+1)+'</td>\
                    <td>'+permission.name+'</td>\
                    <td>\
                    <button type="button" class="btn btn-danger delete-permission" data-id="'+permission.id+'" title="Supprimer"><i class="fa fa-times"></i></button>\
                    <button type="button" class="btn btn-info update-permission" data-id="'+permission.id+'" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>\
                    </td>\
                </tr>\
                ';
            })

            $('#permissions-table tbody').html(row)
            // $('#permissions-table').DataTable();
        },
        error: function (errors) {
            errorMessages(errors);
        }
    });
}
$(function(){
    initialize();
});


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
 * Insert New Permission
 ************************************* 
*/
$('#insert-permission').click(function(e){
    
    e.preventDefault();
    var permission_field = $('#permission_name_add');
    var validation = [
        {'field': permission_field, 'type': 'text'},
    ];
    if(!inputsValidation(validation)) return;

    $.ajax({
        type:'POST',
        data: {name: permission_field.val()},
        url: url_permissions,
        dataType: 'json',
        success: function () {
            swalSuccess('','Inserted Successfully');
            $('form :input').val('');
            getPermissions();
        },
        error: function (errors) {
            errorMessages(errors)
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
$('body').on('click','.update-permission',function(){
    var permission_field = $('#permission_name_modal');
    
    // Get permission Information
    var id = $(this).data('id');
     $.get(url_permissions+'/'+id+'/edit', function (data) {
        // get field values
        permission_field.val(data.name);
    });
   
    // Show Modal
    $('.updateModalPermission').modal('toggle');
    $('.update-data').unbind('click').click(function(){
        //Validation
        var validation = [
            {'field': permission_field, 'type': 'text'},
        ];
    
        if(!inputsValidation(validation)) return;

        // Send Updated Data
        $.ajax({
            type:'PUT',
            data: {name: permission_field.val()},
            url: url_permissions+'/'+id,
            dataType: 'json',
            success: function (data) {
                swalSuccess('','Updated Successfully');
                getPermissions();
            },
            error: function (errors) {
                errorMessages(errors);
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
        console.log(url_models+'/'+id);
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
    getBrands();
    
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