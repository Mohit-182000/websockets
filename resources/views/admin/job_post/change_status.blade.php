<div class="modal fade" id="changeStatus" role="dialog" aria-labelledby="changeStatus" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">Edit Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.update_status') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        
                        <div class="row">
                            <input type="hidden" name="job_id" value="{{$job->id}}">
                            <div class="col-md-12  pr-3">

                                <div class="form-group">
                                    <label for="category">Job Status </label>
                                    <select class="form-control status-select2" name="is_status" data-clear="" data-target=""  data-rule-required="true" data-msg-required="This field is required">
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Expired">Expired</option>
                                    </select>
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

<script src="{{ asset('assets/admin/js/validation/job-post-validation.js') }}"></script>
