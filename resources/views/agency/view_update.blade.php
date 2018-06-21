<!-- Agency Modal -->
@modal(['section' => 'Agency','title' => 'Modifier Agence'])
    <form action="" id="update-agence-frm">
        <div class="form-group">
            <label for="agence_name_modal" class="control-label mb-1">Nom D'agence</label>
            <input id="agence_name_modal" name="agence_name_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
        </div>
        <div class="form-group">
            <label for="agence_fullname_modal" class="control-label mb-1">Nom Complet</label>
            <input id="agence_fullname_modal" name="agence_fullname_modal" type="text" class="form-control" aria-required="true" aria-invalid="false">
        </div>
        <div class="form-group">
            <label for="agence_reference_modal" class="control-label mb-1">Reference</label>
            <input id="agence_reference_modal" name="agence_reference_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
        </div>
        <div class="form-group">
            <label for="agence_tel_modal" class="control-label mb-1">Telephone</label>
            <input id="agence_tel_modal" name="agence_tel_modal" type="tel" class="form-control" aria-required="true" aria-invalid="false" required>
        </div>
        <div class="form-group">
            <label for="agence_email_modal" class="control-label mb-1">Email</label>
            <input id="agence_email_modal" name="agence_email_modal" type="email" class="form-control" aria-required="true" aria-invalid="false" >
        </div>
        <div class="form-group">
            <label for="agence_email_modal" class="control-label mb-1">Adresse</label>
            <textarea id="agence_address_modal" name="agence_address_modal" class="form-control" aria-required="true" aria-invalid="false"></textarea>
        </div>
        <div class="form-group">
            <label for="agence_ville_modal" class="control-label mb-1">Ville</label>
            <select name="agence_city_modal" id="agence_city_modal" class="form-control" required>
                <option value=""></option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
    </form>
@endmodal
<!-- End Agency Modal -->

<!-- Agency Info Modal -->
@modal(['section' => 'AgencyInfo','title' => 'Detail d\'agence', 'update'=>false])
<div class="table-responsive table--no-card m-b-30">
    <table style="width:100%" class="table table-borderless table-striped  text-center" id="agency-info-modal">
        <tbody></tbody>
    </table>
</div>
@endmodal
<!-- Agency Info Modal -->