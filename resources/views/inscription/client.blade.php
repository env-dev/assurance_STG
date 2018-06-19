<div class="card">
    <div class="card-header">
    <strong>Informations</strong> sur le client
    </div>
    <div class="card-body card-block row">
        <div class="col-6 ">
            <div class="form-group">
                <label for="name" class="control-label mb-1">Nom</label>
                <input id="name" name="last_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
            </div>
        </div>
        <div class="col-6">
            <label for="x_card_code" class="control-label mb-1">Prénom</label>
            <div class="input-group">
                <input id="first_name" name="first_name" type="text" class="form-control cc-cvc" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <div class="col col-md-3">
                    <label for="email-input" class=" form-control-label">Email</label>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Entrer Email" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-6">
            <label for="birthdate" class="control-label mb-1">Date de naissance</label>
            <div class="input-group">
            <div class="input-group date" id="birthdate" data-target-input="nearest">
                <input type="text" name="birth_date" class="form-control datetimepicker-input" data-target="#birthdate" required/>
                <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>

            </div>
        </div>
        <div class="col-6 ">
            <div class="form-group">
                <label for="address" class="control-label mb-1">Adresse</label>
                <input id="address" name="address" type="text" class="form-control" required>
                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
            </div>
        </div>
        <div class="col-6 ">
            <div class="form-group">
                <label for="address" class="control-label mb-1">Tel</label>
                <input id="tel" name="tel" type="text" class="form-control" required>
                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
            </div>
        </div>
        <div class="col-6 ">
            <div class="form-group">
                <label for="city" class=" form-control-label">Ville</label>
                <input type="text" id="city" name="city" placeholder="Votre ville" class="form-control" required>
                
            </div>
        </div>
        <div class="col-6 ">
            <div class="form-group">
                <div class="col col-md-3">
                    <label for="nature" class=" form-control-label">Nature</label>
                </div>
                <div class="input-group">
                    <select name="nature" id="nature" class="form-control" required>
                        <option value="">-----</option>
                        <option value="Particulier">Particulier</option>
                        <option value="Entreprise">Entreprise</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6 ">
            <div class="form-group type_id">
                <label for="id" class=" form-control-label">CIN</label>
                <input type="text" name="num_id" id="id" placeholder="Votre identifiant" class="form-control" required>
                <input type="hidden" name="type_id" id="type_id" value="CIN">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button href="#pills-device" class="next-step btn btn-primary btn-sm float-right" data-toggle="pill" role="tab" aria-controls="pills-marque" aria-selected="true">
            <i class="fa fa-dot-circle-o"></i> Suivant
        </button>
    </div>
</div>
