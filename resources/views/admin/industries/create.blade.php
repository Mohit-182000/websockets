<div class="modal fade" id="addindustries" role="dialog" aria-labelledby="addindustries" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">{{ __('industries.create_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.industries.store') }} " method="post" id="industriesForm" name="industriesForm"  enctype="multipart/form-data" data-url="{{ route('check.exist') }}"  >
                        @csrf
                    <div class="modal-body">
                        
                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">Image <span class="text-danger">*</span></label>
                                            <span class="float-right">Note : Image size must be 512 x 512</span>
                                            <input type="file" name="image" id="image" id="name"  data-rule-required="true" data-rule-filesize="5000000" class="form-control">
                                         </div>
                                            
                                    </div>

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">{{ __('industries.form.name') }} <span class="text-danger">*</span></label>
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


<script src="{{ asset('assets/admin/js/validation/industries-validation.js') }}"></script>