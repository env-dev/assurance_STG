<div class="row" id="phone">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">Ajouter Nouveau Appareil</div>
            <div class="card-body">
                <form action="" method="post" id="commentForm">
                    <div class="form-group">
                        <label for="appareil_model_add" class="control-label mb-1">Model</label>
                        <select id="appareil_model_add" name="appareil_model_add" class="form-control" required>
                            <option></option>
                            @foreach($models as $model)
                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imei_add" class="control-label mb-1">IMEI</label>
                        <input  id="imei_add" name="imei_add" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                        <small id="model_price_add_help" class="form-text text-muted">IMEI doit être numerique</small>
                    </div>
                    <div>
                        <button id="insert-appareil" type="submit" class="btn btn-lg btn-info btn-block">
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
            <table class="table table-borderless table-striped table-earning text-center" id="smartphones-table" style="width:100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Marque</th>
                        <th>Model</th>
                        <th>IMEI</th>
                        <th>action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>