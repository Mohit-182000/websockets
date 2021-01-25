<div class="modal fade" id="editindustries" role="dialog" aria-labelledby="editindustries" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">{{ __('industries.edit_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.industries.update',$industries->id) }} " method="post" id="industriesForm" name="industriesForm" data-url="{{ route('check.exist') }}" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="{{ $industries->id }}">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                        
                                <div class="row">

                                    
                                    <div class="col-md-6  pr-3">

                                        <div class="form-group">
                                            <input type="file" name="image" class="form-control">
                                            <input type="hidden" name="old_img" value="{{$industries->image}}">
                                         </div>
                                            
                                    </div>

                                    <div class="col-md-6  pr-3">
                                        <img src="{{  $industries->industries_image }}" height="100">
                                        <label></label>
                                    </div>


                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">{{ __('industries.form.name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"  data-rule-required="true" value="{{$industries->name ?? ''}}" class="form-control">
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


    <script src="{{ asset('assets/admin/js/validation/industries-validation.js') }}"></script>

