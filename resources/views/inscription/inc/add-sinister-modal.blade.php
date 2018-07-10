<!-- Sinister-->
<div class="modal fade" id="add_sinister" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Ajouter un sinistre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <!-- <div class="col col-md-3">
                                <label class=" form-control-label"> <strong>Nom & prénom:</strong></label>
                            </div>
                            <div class="col col-md-3">
                                <span  id="full_name_client"></span>
                            </div> -->
                            <!-- ------------- -->
                            <div class="col col-md-3">
                                <label for="sinister_type" class="form-control-label"> <strong>Type du sinistre:</strong></label>
                            </div>
                            <div class="col col-md-6">
                                <select name="sinister_type" id="sinister_type" class="form-control" required>
                                    <option value="">Selectionnez un type</option>
                                    <option value="10">Casse d’écran seule</option>
                                    <option value="20">Casse toutes causes</option>
                                    <option value="30">Oxydation</option>
                                    <option value="40">Défaillance constructeur</option>
                                </select>
                            </div>
                            <!-- ------------------- -->
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label"> <strong>Place du sinistre:</strong></label>
                            </div>
                            <div class="col col-md-3">
                                <input type="text" class="form-control" id="place_sinister" required>
                            </div>
                            <!-- ----------- -->
                            <div class="col col-md-3">
                                <label class=" form-control-label"> <strong>Date du sinistre:</strong></label>
                            </div>
                            <div class="col col-md-3">
                                <div class="input-group">
                                    <div class="input-group date" id="sinisterDate" data-target-input="nearest">
                                        <input type="text" name="sinister_date" id="sinister_date" class="form-control datetimepicker-input" data-target="#sinisterDate" required/>
                                        <div class="input-group-append" data-target="#sinisterDate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ------------ -->
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label"> <strong>Cause du sinistre:</strong></label>
                            </div>
                            <div class="col col-md-9">
                                <textarea name="" cols="10" rows="10" class="form-control" id="cause_sinister" required></textarea>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <input type="hidden" id="registration_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="register_sinister">Confirmer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END -->