<!-- Appareil Modal -->
@modal(['section' => 'Permission','title' => 'Modifier Permission'])
    <div class="form-group">
        <label for="permission_name_modal" class="control-label mb-1">Nom</label>
        <input id="permission_name_modal" name="permission_name_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
    </div>
@endmodal
<!-- End Appareil Modal -->
<!-- Appareil Modal -->
@modal(['section' => 'Appareil','title' => 'Modifier Appareil'])
    <div class="form-group">
        <label for="appareil_model_modal" class="control-label mb-1">Model</label>
        
    </div>
    <div class="form-group">
        <label for="imei_modal" class="control-label mb-1">IMEI</label>
        <input id="imei_modal" name="imei_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
    </div>
@endmodal
<!-- End Appareil Modal -->