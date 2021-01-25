<div class="modal fade" id="editmarital_status" role="dialog" aria-labelledby="editmarital_status" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">{{ __('marital_status.edit_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.marital-status.update',$marital_status->id) }} " method="post" id="marital_statusForm" name="marital_statusForm" data-url="{{ route('check.exist') }}">
                        <input type="hidden" name="id" id="id" value="{{ $marital_status->id }}">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                        
                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">{{ __('marital_status.form.name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"  data-rule-required="true" value="{{$marital_status->name ?? ''}}" class="form-control">
                                         </div>
                                            
                                    </div>
                                </div>
                        
                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                                
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-default">{{ __('common.btn_cancel') }}</button>
                             <button type="submit" class="btn btn-save-update btn-sm btn-success">{{ __('common.btn_update') }}</button>
                            
                        </div>
                    </div>

                </form>


            </div>
    </div>
</div>


    <script src="{{ asset('assets/admin/js/validation/marital_status-validation.js') }}"></script>

