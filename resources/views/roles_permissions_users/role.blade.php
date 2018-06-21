<div class="row" id="phone">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">Ajouter Nouveau Role</div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="role_name_add" class="control-label mb-1">Nom</label>
                        <input id="role_name_add" name="role_name_add" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="role_display_name_add" class="control-label mb-1">Nom d'affichage</label>
                        <input id="role_display_name_add" name="role_display_name_add" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                    </div>
                    <div class="form-group">
                        <label for="role_description_add" class="control-label mb-1">Description</label>
                        <input id="role_description_add" name="role_description_add" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                    </div>
                   <!-- <div class="form-group">
                        <label for="role_permission_add" class="control-label mb-1">Permissions</label>
                        <select id="role_permission_add" name="role_permission_add" class="form-control" multiple required>
                            <option></option>
                           
                        </select>
                    </div>-->
                    <div>
                        <button id="insert-role" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-plus-square"></i>&nbsp;
                            <span> Ajouter</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="table-responsive table--no-card m-b-30">
            <table class="table table-borderless table-striped table-earning text-center" id="roles-table" style="width:100%;">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Nom d'affichage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>{{$role->display_name}}</td>
                        <td>
                            <button type="button" class="btn btn-danger delete-role" data-id="{{ $role->id }}" title="Supprimer"><i class="fa fa-times"></i></button>
                            <button type="button" class="btn btn-info update-role" data-id="{{ $role->id }}" title="Modifier"><i class="fa fa-pencil-square-o"></i></button>
                            <button type="button" class="btn btn-warning info-role" data-id="{{ $role->id }}" title="info">&nbsp;<i class="fa fa-info"></i>&nbsp;</i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>