<div class="row" id="phone">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">Ajouter bulk Appareils</div>
            <div class="card-body">
                <form id="import-form" enctype="multipart/form-data">
                    <div id="response"></div>
                    <div class="input-group">
                        <div class="custom-file">
                            @csrf
                            <input type="file" class="custom-file-input" id="smart_file" name="smart_file" accept=".xlsx,.xls" required>
                            <label class="custom-file-label" for="smart_file">Choisisser votre fichier</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="btn-import">Importer</button>
                        </div>
                    </div>
                    <small id="file_add_help" class="form-text text-muted">Les extensions autorisé : xlsx, xls</small>
                </form>
            </div>
        </div>
        {{-- <div class="accordion" id="accordionExample">
            @if (Session::has('feedback'))
            <div class="alert alert-warning">
                {{Session::get('feedback')}}
            </div>
            @endif
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Bulk insertion des appareils
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Individuale insertion
                    </button>
                </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
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
                                    <small id="imei_add_help" class="form-text text-muted">IMEI doit être numerique</small>
                                </div>
                                <div class="form-group">
                                    <label for="imei_add" class="control-label mb-1">IMEI 2</label>
                                    <input  id="imei2_add" name="imei2_add" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                                    <small id="imei2_add_help" class="form-text text-muted">IMEI 2 doit être numerique</small>
                                </div>
                                 <div class="form-group">
                                    <label for="sn_add" class="control-label mb-1">SN</label>
                                    <input  id="sn_add" name="sn_add" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                                    <small id="sn_add_help" class="form-text text-muted">SN doit être numerique</small>
                                </div>
                                <div class="form-group">
                                    <label for="wifi_add" class="control-label mb-1">WIFI</label>
                                    <input  id="wifi_add" name="wifi_add" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                                    <small id="wifi_add_help" class="form-text text-muted">IMEI doit être numerique</small>
                                </div>
                                <br><br>
                                <div class="input-group">
                                    <button id="insert-appareil" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa fa-plus-square"></i>&nbsp;
                                        <span> Ajouter</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div> --}}
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
                        <th>IMEI 2</th>
                        <th>action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>