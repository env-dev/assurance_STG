<div class="modal fade" id="export-pick-date" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" data-backdrop="static" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">Date d'export</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="export_date" class="control-label mb-1 text-center">Selectionnez la date d'export</label>
                <div class="input-group">
                <input type="text" name="registration_export_date" id="registration_export_date" class="form-control datetimepicker-input" data-target="#export_date" required/>
                    <div class="input-group-append" data-target="#export_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="export">Confirm</button>
            </div>
        </div>
    </div>
</div>