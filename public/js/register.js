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

    
    //getPermissions()
    //getRoles();
    //$('#role_permission_add').select2();
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
    if(data.responseJSON.message){
        swalError("Invalid Data",errors + "\n ------- \n" + data.responseJSON.message);
    }else{
        swalError(data.responseJSON);
    }
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
/*function getPermissions(){
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
}*/

function getRoles(){
    $.ajax({
        type:'GET',
        url: url_roles,
        dataType: 'json',
        success: function (roles) {
            let row =''
            $.each(roles, function(index,role){
                row += '\
                <tr>\
                    <td>'+role.name+'</td>\
                    <td>'+role.display_name+'</td>\
                    <td>\
                    <button type="button" class="btn btn-danger delete-role" data-id="'+role.id+'" title="Supprimer"><i class="fa fa-times"></i></button>\
                    <button type="button" class="btn btn-info update-role" data-id="'+role.id+'" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>\
                    <button type="button" class="btn btn-warning info-role" data-id="'+role.id+'" title="Details">&nbsp;<i class="fa fa-info"></i>&nbsp;</i></button>\
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
        url: url_users,
        dataType: 'json',
        success: function (users) {
            let row =''
            $.each(users, function(i,user){
                row += '\
                <tr>\
                    <td>'+user.name+'</td>\
                    <td>'+user.username+'</td>\
                    <td>\
                    <button type="button" class="btn btn-danger delete-user" data-id="'+user.id+'" title="Supprimer"><i class="fa fa-times"></i></button>\
                    <button type="button" class="btn btn-info update-user" data-id="'+user.id+'" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>\
                    </td>\
                </tr>\
                ';
            })

            $('#users-table tbody').html(row)
            // $('#users-table').DataTable();
        },
        error: function (errors) {
            errorMessages(errors);
        }
    });
}
$(function(){
    initialize();



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
    // var role_permission_add = $('#role_permission_add');
    var role_display_name_add = $('#role_display_name_add');
    var role_description_add = $('#role_description_add');
    var validation = [
        {'field': role_field, 'type': 'text'},
    ];

    if(inputsValidation(validation)){
        $.ajax({
            type:'POST',
            data: {
                name: role_field.val(),
                display_name: role_display_name_add.val(),
                description: role_description_add.val()
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

$('form#insert-user-frm').submit(function(e){
    e.preventDefault();

    var formData = $(this).serialize();
   // console.log(formData);return;//
    $.ajax({
        type:'POST',
        url:url_users,
        dataType: 'json',
        data: formData,
        success: function (data) {
            swalSuccess('','User Inserted successfully');
            $('form :input').val('');
            getUsers();
        },
        error: function(errors){
            errorMessages(errors);
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
 * Update Role
 ************************************* 
*/
$('body').on('click','.update-role',function(){
    var roleName = $('#role_name_modal');
    var displayName = $('#role_display_name_modal');
    var description = $('#role_description_modal');
    $('form#update-role-frm :input').val('');
    // Get role Information
    var id = $(this).data('id');
    var url = url_roles+'/'+id;
    $.ajax({
        type:"GET",
        url:url,
        success: function(role){
            roleName.val(role.name);
            displayName.val(role.display_name);
            description.val(role.description);
            $('.updateModalRole').modal('toggle');
        },
        error: function(error){
            errorMessages(error);
        }
    });
    // Show Modal
    $('.update-data').unbind('click').click(function(e){
            // Send Updated Data
            $.ajax({
                type:'PUT',
                data: {
                    name: roleName.val(),
                    display_name: displayName.val(),
                    description: description.val()
                },
                url: url,
                dataType: 'json',
                success: function (data) {
                    swalSuccess('','role Updated successfully')
                    getroles();
                },
                error: function (data) {
                    console.log(data)
                    errorMessages(data);
                }
            });
    });
});

/**
 ************************************* 
 * Update User
 ************************************* 
*/
$('body').on('click','.update-user',function(){
    // Get user Information
    var id = $(this).data('id');
    var url = url_users+'/'+id; 
    $.get(url, function (data) {
      //  console.log(data);
        $('#name_modal').val(data.user.name);
        $('#username_modal').val(data.user.username);
        $('#email_modal').val(data.user.email);
        $('#role_modal').val(data.role);
        $('#agence_modal').val(data.user.agence_id);
    });
    // Show Modal
    $('.updateModalUser').modal('toggle');
    $('.update-data').unbind('click').click(function(e){
        e.preventDefault();

        formData = $('form#update-user-frm').serialize();
        // Send Updated Data
        $.ajax({
            type:'PUT',
            data: formData,
            url: url,
            dataType: 'json',
            success: function (data) {
                swalSuccess('','User Updated successfully')
                getUsers();
            },
            error: function (data) {
                console.log(data);
               // errorMessages(data);
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
    var msg = "";
    deleteOperation(url,'',"Permission is deleted successfully");
    getPermissions();
    
});

/**
 ************************************* 
 * Delete Model
 ************************************* 
*/

$('body').on('click','.delete-role',function(){
    var id = $(this).data('id');
    var url = url_roles+'/'+id;
    var msg = "";
    deleteOperation(url,'',"Role is deleted successfully");
    getRoles();
    
});

/**
 ************************************* 
 * Delete Appareil
 ************************************* 
*/

$('body').on('click','.delete-user',function(){
    var id = $(this).data('id');
    var url = url_users+'/'+id;
    var msg = "";
    deleteOperation(url,'',"User is deleted successfully");
    getUsers();
});

//#endregion

});


// View Role Infos
$('body').on('click','.info-role',function(){
    var id = $(this).data('id');
    var url = url_roles+'/'+id;
    $.ajax({
        type:'GET',
        dataType:'json',
        url:url,
        success:function(role){
            var row ='<tr>\
                    <td>Name</td>\
                    <td>'+role.name+'</td>\
                </tr>\
                <tr>\
                    <td>Display Name</td>\
                    <td>'+role.display_name+'</td>\
                </tr>\
                <tr>\
                    <td>Description</td>\
                    <td>'+role.description+'</td>\
                </tr>\
                <tr>\
                    <td>Permissions</td>\
                    <td><span class="badge badge-pill badge-success">All</span></td>\
                </tr>';
            
            $('#info-role-table tbody').html(row);
            $('.updateModalRoleInfo').modal('toggle');

        },
        error: function(errors){
            errorMessages(errors);
        }
    });    
})