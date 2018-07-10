<div class="modal fade show" id="confirm_reparation" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Informations sur la réparation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-sm-3">
                            <label for="input-normal" class=" form-control-label"><strong>N° pièce d’identité</strong></label>
                        </div>
                        <div class="col col-sm-3">
                            <span id="num_id"></span>
                        </div>
                        <div class="col col-sm-3">
                            <label for="input-normal" class=" form-control-label"><strong>N° Téléphone</strong></label>
                        </div>
                        <div class="col col-sm-3">
                            <span id="tel"></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-3">
                            <label for="input-normal" class=" form-control-label"><strong>Marque</strong></label>
                        </div>
                        <div class="col col-sm-3">
                            <span id="brand"></span>
                        </div>
                        <div class="col col-sm-3">
                            <label for="input-normal" class=" form-control-label"><strong>Modèle appareil</strong></label>
                        </div>
                        <div class="col col-sm-3">
                            <span id="model"></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-3">
                            <label for="input-normal" class=" form-control-label"><strong>N° IMEI appareil</strong></label>
                        </div>
                        <div class="col col-sm-3">
                            <span id="imei"></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-5">
                            <label for="input-normal" class=" form-control-label"><strong>Montant TTC réparation</strong></label>
                        </div>
                        <div class="col col-sm-6">
                            <input type="number" id="price_ttc_reparation" name="price_ttc_reparation" placeholder="Prix totale de la réparation" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-5">
                            <label for="input-normal" class=" form-control-label"><strong>Montant TTC piéces</strong></label>
                        </div>
                        <div class="col col-sm-6">
                            <input type="number" id="price_ttc_replacement" name="price_ttc_replacement" placeholder="Prix totale des piéces" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-5">
                            <label for="input-normal" class=" form-control-label"><strong>Montant TTC main d'oeuvre</strong></label>
                        </div>
                        <div class="col col-sm-6">
                            <input type="number" id="price_ttc_workforce" name="price_ttc_workforce" placeholder="Prix totale de la main-oeuvre" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-5">
                            <label for="input-normal" class=" form-control-label"><strong>Date de réparation</strong></label>
                        </div>
                        <div class="col col-sm-6">
                            <div class="input-group">
                                <div class="input-group date" id="date_rep" data-target-input="nearest">
                                    <input type="text" name="date_reparation" id="date_reparation" class="form-control datetimepicker-input" data-target="#date_rep" required/>
                                    <div class="input-group-append" data-target="#date_rep" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmReparation" data-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>