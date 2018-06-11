<!-- Marque Modal -->
@modal(['section' => 'Marque','title' => 'Modifier Marque'])
    <div class="form-group">
        <label for="marque_name_modal" class="control-label mb-1">Nom</label>
        <input id="marque_name_modal" name="marque_name_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
    </div>
@endmodal
<!-- End Marque Modal -->

<!-- Model Modal -->
@modal(['section' => 'Model','title' => 'Modifier Model'])
    <div class="form-group">
        <label for="model_marque_modal" class="control-label mb-1">Marque</label>
        <select id="model_marque_modal" name="model_marque_modal" class="form-control">
            @foreach($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="model_name_modal" class="control-label mb-1">Nom</label>
        <input id="model_name_modal" name="model_name_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
    </div>
    <div class="form-group">
        <label for="model_price_model" class="control-label mb-1">Prix</label>
        <input id="model_price_model" name="model_price_model" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
        <small id="model_price_model_help" class="form-text text-muted">Prix doit être numerique</small>
    </div>
@endmodal
<!-- End Model Modal -->

<!-- Appareil Modal -->
@modal(['section' => 'Appareil','title' => 'Modifier Appareil'])
    <div class="form-group">
        <label for="appareil_model_modal" class="control-label mb-1">Model</label>
        <select id="appareil_model_modal" name="appareil_model_modal" class="form-control">
            @foreach($models as $model)
            <option value="{{ $model->id }}">{{ $model->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="imei_modal" class="control-label mb-1">IMEI</label>
        <input id="imei_modal" name="imei_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
    </div>
@endmodal
<!-- End Appareil Modal -->