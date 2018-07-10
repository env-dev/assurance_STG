<!-- Begin consulting registation modal -->
<div class="modal fade" id="consult_sinister" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Informations sur le sinistre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <label class="col-lg-6"> <strong>Nom & prénom:</strong> </label>
                        <span class="col-lg-6" id="full_name_client"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> <strong>Telephone:</strong> </label>
                        <span class="col-lg-6" id="tel_client"></span>
                    </div>
                    <div class="col-lg-8">
                        <label class="col-lg-4"> <strong>Type sinistre:</strong> </label>
                        <span class="col-lg-8" id="sinister_type"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> <strong>Décision AON:</strong> </label>
                        <span class="col-lg-6" id="sinister_aon_decision"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> <strong>IMEI:</strong> </label>
                        <span class="col-lg-6" id="imei_device"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> <strong>Marque:</strong> </label>
                        <span class="col-lg-6" id="brand_device"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> <strong>Modéle:</strong> </label>
                        <span class="col-lg-6" id="model_device"></span>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-6"> <strong>Date du sinistre:</strong> </label>
                        <span class="col-lg-6" id="date_sinister"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <label class="col-lg-5"> <strong>Lieu du inistre:</strong> </label>
                        <span class="col-lg-7" id="place_sinister"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <label class="col-lg-6"> <strong>Cause du sinistre:</strong> </label>
                        <span class="col-lg-6" id="cause_sinister"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="consulted_reg" data-id="0" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>