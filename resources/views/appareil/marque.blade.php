<div class="row" id="marque">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">Ajouter Nouveau Marque</div>
            <div class="card-body">
                <form class="cmxform" >
                    <div class="form-group">
                        <label for="marque_name_add" class="control-label mb-1">Nom</label>
                        <input id="marque_name_add" name="marque_name_add" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>
                    <div>
                        <button id="insert-marque" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-plus-square"></i>&nbsp;
                            <span id="btn-submit"> Ajouter</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="table-responsive table--no-card m-b-30">
            <table style="width:100%" class="table table-borderless table-striped table-earning text-center" id="brands-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>action</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>