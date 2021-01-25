<div class="modal fade" id="editlocality" role="dialog" aria-labelledby="editlocality" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">Edit Locality</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>


                    <form action="{{ route('admin.locality.update',$locality->id) }} " method="post" id="localityForm" name="localityForm" data-url="{{ route('check.exist') }}">
                        <input type="hidden" name="id" id="id" value="{{ $locality->id }}">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                        
                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="category">{{ __('category.form.category') }} </label>

                                            <select class="form-control category-select2" name="state_id" id="category" data-url="{{ route('get.state') }}" data-clear="" data-target=""  data-rule-required="true" data-msg-required="This field is required">
                                                <option value="{{ $locality->state_id }}">
                                                    {{ $locality->state->name }}
                                                </option>
                                            </select>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="title">City <span class="text-danger">*</span></label>
                                            <select class="form-control city-select2" name="city_id" id="city" data-clear="" data-url="{{ route('get.city') }}" data-target=""  data-rule-required="true" data-msg-required="This field is required">
                                                <option value="{{ $locality->city_id }}">
                                                    {{ $locality->city->name }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">{{ __('skills.form.name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"  data-rule-required="true" value="{{$locality->name ?? ''}}" class="form-control">
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
    
    <script src="{{ asset('assets/admin/js/validation/locality-validation.js') }}"></script>
