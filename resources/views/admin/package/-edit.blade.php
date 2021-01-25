<div class="modal fade" id="edit_package" role="dialog" aria-labelledby="edit_package" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">Edit Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.package.update',$package->id) }} " method="post" id="packageForm" name="packageForm" data-url="{{ route('check.exist') }}">
                        <input type="hidden" name="id" id="id" value="{{ $package->id }}">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                        
                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">{{ __('marital_status.form.name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" value="{{ $package->name }}" data-rule-required="true" class="form-control">
                                         </div>
                                            
                                    </div>

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">Price <span class="text-danger">*</span></label>
                                            <input type="text" name="price" data-rule-number="true" value="{{ $package->price }}" data-rule-maxlength="5" data-rule-required="true" class="form-control">
                                         </div>
                                            
                                    </div>

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">Validity <span class="text-danger">*</span></label>
                                            <input type="text" name="validity"  data-rule-required="true" value="{{ $package->validity }}" data-rule-number="true" data-rule-maxlength="2" class="form-control">
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


    <script src="{{ asset('assets/admin/js/validation/packge-validation.js') }}"></script>

