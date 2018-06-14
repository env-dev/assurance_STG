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
    getRoles();
    $('#role_permission_add').select2();
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

function getRoles(){
    $.ajax({
        type:'GET',
        url: url_roles,
        dataType: 'json',
        success: function (roles) {
            //  console.log(roles); return;
            let row =''
            $.each(roles, function(index,role){
                row += '\
                <tr>\
                    <td>'+(index+1)+'</td>\
                    <td>'+role.name+'</td>\
                    <td>'+role.permissions+'</td>\
                    <td>\
                    <button type="button" class="btn btn-danger delete-role" data-id="'+role.id+'" title="Supprimer"><i class="fa fa-times"></i></button>\
                    <button type="button" class="btn btn-info update-role" data-id="'+role.id+'" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>\
                    </td>\
                </tr>\
                ';
            })

            $('#roles-table tbody').html(row)
            // $('#permissions-table').DataTable();
        },
        error: function (errors) {
            errorMessages(errors);
        }
    });
}

function getUsers(){
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

$('#insert-role').click(function(e){
    e.preventDefault();
    var role_field = $('#role_name_add');
    var role_permission_add = $('#role_permission_add');
    var validation = [
        {'field': role_field, 'type': 'text'},
    ];

    if(inputsValidation(validation)){
        $.ajax({
            type:'POST',
            data: {
                name: role_field.val(),
                permissions: role_permission_add.val()
            },
            url: url_roles,
            dataType: 'json',
            success: function (data) {
               swalSuccess('','Role is inserted Successfully');
               getRoles();
               $('form input').val('');
            },
            error: function (errors) {
                errorMessages(errors);
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
 * Update Permission
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
$('body').on('click','.update-role',function(){
    var role_name_field = $('#permission_name_modal');
    var role_permissions_field = $('#role_permission_modal');
    
   
    // Get role Information
    var id = $(this).data('id');
    $.get(url_roles+'/'+id+'/edit', function (role) {
        console.log(role);return;
        // get field values
        role_name_field.val(role.name)
    });
return;
    // Show Modal
    $('.updateModalrole').modal('toggle');
    $('.update-data').unbind('click').click(function(e){
        event.stopPropagation();
        //Validation
        var validation = [
            {'field': role_name_field, 'type': 'text'},
            {'field': role_price_role, 'type': 'numeric'},
        ];
        if(!inputsValidation(validation)) return;
        console.log(url_roles+'/'+id);
            // Send Updated Data
            $.ajax({
                type:'PUT',
                data: {
                    name: role_name_field.val(),
                    marque: role_marque_field.val(),
                    price_ttc: role_price_role.val()
                },
                url: url_roles+'/'+id,
                dataType: 'json',
                success: function (data) {
                    swalSuccess('','role Updated successfully')
                    getroles();
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

$('body').on('click','.delete-permission',function(){

    var id = $(this).data('id');
    var url = url_permissions+'/'+id;
    var msg = "Once deleted, you will remove all Phones are related to this Permission!";
    deleteOperation(url,'',"Permission is deleted successfully");
    getPermissions();
    
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