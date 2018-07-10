<!-- END DATA TABLE-->
<div class="modal fade" id="addAvenant" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Informations sur l'avenant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">La garantie à ajouter</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="select" id="extensions" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="disabled-input" class=" form-control-label">Surprime TTC</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="hidden" id="price_ttc">
                                <input type="hidden" id="registration_id">
                                <input type="text" id="surprime_ttc" placeholder="Surprime..." disabled="" class="form-control">
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="add_avenant" data-dismiss="modal">Confirmer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END -->