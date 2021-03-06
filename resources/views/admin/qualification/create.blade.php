<div class="modal fade" id="addqualification" role="dialog" aria-labelledby="addqualification" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">{{ __('qualification.create_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.qualification.store') }} " method="post" id="qualificationForm" name="qualificationForm" data-url="{{ route('check.exist') }}">
                        @csrf
                    <div class="modal-body">
                        
                        <div class="row">

                            <div class="col-md-12  pr-3">

                                <div class="form-group">
                                    <label for="title">{{ __('qualification.form.name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"  data-rule-required="true" class="form-control">
                                    </div>
                                    
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12  pr-3">

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="is_show_in_feild_of_study" id="customCheckbox1" value="1">
                                        <label for="customCheckbox1" class="custom-control-label">{{ __('qualification.form.is_show') }}</label>
                                    </div>
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


    <script src="{{ asset('assets/admin/js/validation/qualification-validation.js') }}"></script>



