<div class="modal fade" id="addexperience" role="dialog" aria-labelledby="addexperience" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">{{ __('experience.create_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.experience.store') }} " method="post" id="experienceForm" name="experienceForm" data-url="{{ route('check.exist') }}">
                        @csrf
                    <div class="modal-body">
                        
                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">{{ __('experience.form.name') }} <span class="text-danger">*</span></label>
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


    <script src="{{ asset('assets/admin/js/validation/experience-validation.js') }}"></script>



