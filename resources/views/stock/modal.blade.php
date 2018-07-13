<!-- Bulk Smartphone Insertion Modal -->
@modal(['section' => 'BulkInsertion','title' => 'Gestion Stock','update'=>false])
    {{-- <h4 class="text-info m-b-10">#1 Choisire une Agence</h4>
    <div class="form-group">
        <label for="agence_modal" class="control-label mb-1">Agence</label>
        <select id="agence_modal" name="agence_modal"class="form-control" aria-required="true" aria-invalid="false">
            <option value=""></option>
            @foreach($agencies as $agency)
            <option value="{{ $agency->id }}">{{ $agency->full_name }}</option>
            @endforeach
        </select>
    </div> --}}
    <h4 class="text-info m-b-10"># Mode d'opération</h4>
    <div class="response"></div>
    <div class="form-group">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header bg-secondary" id="headingOne">
                <h5 class="mb-0">
                    <button class="text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Classic 
                    </button>
                </h5>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <form id="classic-form" action="">
                        <input type="hidden" name="action" id="action" value="classic1">
                        <div class="form-group">
                            <label for="imei_modal" class="control-label mb-1">IMEI 1</label>
                            <select id="imei_modal" name="imei_modal[]"class="form-control" aria-required="true" aria-invalid="false" multiple required>
                                {{-- <option value=""></option>
                                @foreach($smartphones as $smartphone)
                                <option value="{{ $smartphone->id }}">{{ $smartphone->imei }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn float-right submit-action">Insert</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-secondary" id="headingTwo">
                <h5 class="mb-0">
                    <button class="text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Classic 2
                    </button>
                </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <form id="classic2-form" action="">
                        <input type="hidden" name="action" id="action" value="classic2">
                        <div class="form-group">
                            <label for="imei_list_modal" class="control-label mb-1">IMEI 1 - Liste</label>
                            <textarea name="imei_list_modal" id="imei_list_modal" cols="30" rows="10" class="form-control" placeholder="21254548789899" required></textarea>
                            <small id="imei_list_modal_help" class="form-text text-muted">Chaque IMEI sur un nouveau ligne, max:100</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn float-right submit-action">Insert</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-secondary" id="headingThree">
                <h5 class="mb-0">
                    <button class="text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Bulk
                    </button>
                </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    <form id="bulk-form" enctype="multipart/form-data" if-match="*">
                        <input type="hidden" name="action" id="action" value="bulk">
                        <div class="input-group">
                            <div class="custom-file">
                                @csrf
                                <input type="file" class="custom-file-input" id="smart_file" name="smart_file" accept=".xlsx,.xls" required>
                                <label class="custom-file-label" for="smart_file">Choisisser votre fichier</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="btn-import">Importer</button>
                            </div>
                        </div>
                        <small id="file_add_help" class="form-text text-muted">Les extensions autorisé : xlsx, xls</small>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
@endmodal
<!-- End Bulk Smartphone Insertion Modal -->