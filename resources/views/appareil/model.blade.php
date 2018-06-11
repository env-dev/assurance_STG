<div class="row" id="model">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">Ajouter Nouveau Model</div>
            <div class="card-body">
                <form method="POST">
                    <div class="error">
                        @alert(['type'=>'error'])
                            <span class="error-msg"></span>
                        @endalert
                    </div>
                    <div class="form-group">
                        <label for="model_marque_add" class="control-label mb-1">Marque</label>
                        <select id="model_marque_add" name="model_marque_add" class="form-control">
                            <!-- <option value="1" selected>STG</option> -->
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="model_name_add" class="control-label mb-1">Nom</label>
                        <input id="model_name_add" name="model_name_add" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="model_price_add" class="control-label mb-1">Prix</label>
                        <input id="model_price_add" name="model_price_add" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                        <small id="model_price_add_help" class="form-text text-muted">Prix doit être numerique</small>
                    </div>
                    <div>
                        <button id="insert-model" type="submit" class="btn btn-lg btn-info btn-block">
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
            <table class="table table-borderless table-striped table-earning text-center" id="models-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Marque</th>
                        <th>Model</th>
                        <th>actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
    