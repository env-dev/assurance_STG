<div class="col-xs-8 offset-xs-2">
    <div class="card">
        <div class="card-header">
            <strong>Informations</strong> sur l'inscription
        </div>
        <div class="card-body card-block">
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Numero du mandat</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="mandat_num" name="mandat_num" placeholder="Text" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="select" class=" form-control-label">La garantie</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="guarantee" id="guarantee" class="form-control">
                            <option value="100">Selectionnez une garantie</option>
                            <option value="110">F2</option>
                            <option value="111">F3</option>
                        </select>
                        <small class="form-text text-muted">La garantie F1 est inclu par defaut</small>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Date flux de données</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="input-group date" id="date_flow_data" data-target-input="nearest">
                            <input type="text" name="date_flow_data" class="form-control datetimepicker-input" data-target="#date_flow_data" required/>
                            <div class="input-group-append" data-target="#date_flow_data" data-toggle="datetimepicker">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Total TTC</label>
                    </div>
                    <div class="col-12 col-md-9">
                    <input type="text" name="total_ttc" id="total_ttc" class="form-control" readonly>
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <button type="submit" id="saveRegistration" class="btn btn-primary btn-sm float-right">
                <i class="fa fa-dot-circle-o"></i> Enregistrer
            </button>
        </div>
    </div>
</div>