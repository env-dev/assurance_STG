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
        <label for="role_name_modal" class="control-label mb-1">Nom</label>
        <input id="role_name_modal" name="role_name_modal" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
    </div>
    <div class="form-group">
        <label for="role_permission_modal" class="control-label mb-1">Permissions</label>
        <select id="role_permission_modal" name="role_permission_modal" class="form-control" multiple required>
            <option></option>
            @foreach($permissions as $permission)
            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
            @endforeach
        </select>
    </div>
@endmodal
<!-- End Appareil Modal -->