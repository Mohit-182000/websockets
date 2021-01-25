<div class="modal fade" id="addlocality" role="dialog" aria-labelledby="addlocality" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">Locality</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.locality.store') }} " method="post" id="localityForm" name="localityForm"  data-url="{{ route('check.exist') }}"  >
                        @csrf
                    <div class="modal-body">

                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                     <div class="form-group">
                                            <label for="category">State </label>
                                            <select class="form-control category-select2" name="state_id" id="category" data-url="{{ route('get.state') }}" data-clear="" data-target=""  data-rule-required="true" data-msg-required="This field is required">
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">City <span class="text-danger">*</span></label>
                                            <select class="form-control city-select2" name="city_id" id="city" data-clear="" data-target="" data-rule-required="true" data-msg-required="This field is required">
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"  data-rule-required="true" class="form-control">
                                        </div>

                                    </div>
                                </div>

                    </div>

                    <div class="card-footer">
                        <div class="float-right">

                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-default">{{ __('common.btn_cancel') }}</button>
                             <button type="submit" class="btn btn-save-update btn-sm btn-success">{{ __('common.btn_save') }}</button>

                        </div>
                    </div>

                </form>


            </div>
    </div>
</div>

    

    <script src="{{ asset('assets/admin/js/validation/locality-validation.js') }}"></script>



