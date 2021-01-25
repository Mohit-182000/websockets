<div class="modal fade" id="adduser_management" role="dialog" aria-labelledby="adduser_management" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">{{ __('user_management.index_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <div class="modal-body">
                        
                        <form method="post" id="statusForm" name="user_managementForm" enctype="multipart/form-data">
                        @csrf
                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">{{ __('user_management.form.name') }}  </label>
                                            <input type="text" name="title" id="title" value="" data-rule-required="false" class="form-control">
                                         </div>

                                        <div class="form-group">
                                            <label for="title">{{ __('user_management.form.email') }}  </label>
                                            <input type="text" name="description" id="description" value="" data-rule-required="false" class="form-control">
                                         </div>

                                        <div class="form-group">
                                            <label for="title">{{ __('user_management.form.profile') }}  </label>
                                            <input type="file" name="profile" id="profile" value="" data-rule-required="false" class="form-control">
                                         </div>

                                        <div class="form-group">
                                            <label for="title">{{ __('user_management.form.mobile') }}  </label>
                                            <input type="text" name="mobile" id="mobile" value="" data-rule-required="false" class="form-control">
                                         </div>

                                        <div class="form-group">
                                            <label for="title">{{ __('user_management.form.role') }}  </label>
                                            <input type="text" name="role" id="role" value="" data-rule-required="false" class="form-control">
                                         </div>
                                            
                                    </div>
                                </div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                                
                            <button type="submit" data-dismiss="modal" class="btn btn-sm btn-default">{{ __('common.btn_cancel') }}</button>
                             <button type="submit" class="btn btn-save-update btn-sm btn-success">{{ __('common.btn_save') }}</button>
                            
                        </div>
                    </div>


            </div>
    </div>
</div>


