<div class="col-xs-8 offset-xs-2">
    <div class="card">
        <div class="card-header">
            <strong>Informations</strong> sur l'inscription
        </div>
        <div class="card-body card-block">
                <!-- <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Numero du mandat</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="mandat_num" name="mandat_num" placeholder="Text" class="form-control" required>
                    </div>
                </div> -->
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
                            <input type="text" name="date_flow_data" id="flow_data" class="form-control datetimepicker-input" data-target="#date_flow_data" required/>
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
                        <label for="text-input" class=" form-control-label">Agence</label>
                    </div>
                    <div class="col-12 col-md-9">
                    <input type="text" name="agency" id="agency" class="form-control" required>
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
            <button type="submit" id="saveRegistration" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#scrollmodal">
                <i class="fa fa-dot-circle-o"></i> Enregistrer
            </button>
        </div>
    </div>
</div>
<!-- modal scroll -->
<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Confirmation d'impression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Nom & prénom: </label>
                        <span class="col-lg-6" id="full_name_client"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Email: </label>
                        <span class="col-lg-6" id="email_client"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Date de naissance: </label>
                        <span class="col-lg-6" id="birthdate_client"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Adresse: </label>
                        <span class="col-lg-6" id="address_client"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Telephone: </label>
                        <span class="col-lg-6" id="tel_client"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Ville: </label>
                        <span class="col-lg-6" id="city_client"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Nature: </label>
                        <span class="col-lg-6" id="client_type"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6" id="id_type"></label>
                        <span class="col-lg-6" id="id_num_client"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> IMEI: </label>
                        <span class="col-lg-6" id="imei_device"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Marque: </label>
                        <span class="col-lg-6" id="brand_device"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Modéle: </label>
                        <span class="col-lg-6" id="model_device"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Prix: </label>
                        <span class="col-lg-6" id="device_price"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Guarantie: </label>
                        <span class="col-lg-6" id="guarantee_device"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> La date de flux de données: </label>
                        <span class="col-lg-6" id="data_flow_date"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Agence: </label>
                        <span class="col-lg-6" id="agency_reg"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> Prix total TTC: </label>
                        <span class="col-lg-6" id="total_price_reg"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmRegistration" data-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal scroll -->