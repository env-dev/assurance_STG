<div class="row" id="phone">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">Ajouter Nouvelle Permission</div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="permission_name_add" class="control-label mb-1">Nom</label>
                        <input id="permission_name_add" name="permission_name_add" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                    </div>
                    <div>
                        <button id="insert-permission" type="submit" class="btn btn-lg btn-info btn-block">
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
            <table class="table table-borderless table-striped table-earning text-center" id="permissions-table" style="width:100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Permissions</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>