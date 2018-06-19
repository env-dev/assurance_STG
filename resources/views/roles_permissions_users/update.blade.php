<!-- View Detail Role Modal -->
@modal(['section' => 'RoleInfo','title' => 'Role Detail', 'update'=>false])
    <table class="table table-borderless table-striped text-center" id="info-role-table" style="width:100%;">
        <tbody></tbody>
    </table>
                
@endmodal
<!-- End View Detail Role Modal -->
<!-- Update Role Modal -->
@modal(['section' => 'Role','title' => 'Modifier Role'])
    <form action="" method="post" id="update-role-frm">
        <div class="form-group">
            <label for="role_name_modal" class="control-label mb-1">Nom</label>
            <input id="role_name_modal" name="role_name_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
        </div>
        <div class="form-group">
            <label for="role_display_name_modal" class="control-label mb-1">Display Name</label>
            <input id="role_display_name_modal" name="role_display_name_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
        </div>
        <div class="form-group">
            <label for="role_description_modal" class="control-label mb-1">Description</label>
            <input id="role_description_modal" name="role_description_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
        </div>
       <!-- <div class="form-group">
            <label for="role_permission_add" class="control-label mb-1">Permissions</label>
            <select id="role_permission_add" name="role_permission_add" class="form-control" multiple required>
                <option></option>
               
            </select>
        </div>-->
    </form>
@endmodal
<!-- End Update Role Modal -->

<!-- Update User Modal -->
@modal(['section' => 'User','title' => 'Modifier Utilisateur'])
<form action="" method="post" id="update-user-frm">
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
            <div class="col-md-6">
                <input id="name_modal" type="text" class="form-control" name="name" value="" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
            <div class="col-md-6">
                <input id="username_modal" type="text" class="form-control" name="username" value="" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            <div class="col-md-6">
                <input id="email_modal" type="email" class="form-control" name="email" value="" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
            <div class="col-md-6">
                <select id="role_modal" class="form-control" name="role" required>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="agence" class="col-md-4 col-form-label text-md-right">{{ __('Agency') }}</label>
            <div class="col-md-6">
                <select id="agence_modal" class="form-control" name="agence">
                    <option value="" ></option>
                    @foreach($agences as $agence)
                        <option value="{{ $agence->id }}">{{ $agence->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
</form>
@endmodal
<!-- End Update User Modal -->
