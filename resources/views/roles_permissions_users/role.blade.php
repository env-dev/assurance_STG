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
                        <label for="role_permission_add" class="control-label mb-1">Permissions</label>
                        <select id="role_permission_add" name="role_permission_add" class="form-control" multiple required>
                            <option></option>
                            @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <th>#</th>
                        <th>role</th>
                        <th>permissions</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>