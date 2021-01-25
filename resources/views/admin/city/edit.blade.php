<div class="modal fade" id="editcity" role="dialog" aria-labelledby="editcity" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">{{ __('city.edit_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.city.update',$city->id) }} " method="post" id="cityForm" name="cityForm" data-url="{{ route('check.exist') }}">
                        <input type="hidden" name="id" id="id" value="{{ $city->id }}">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                        
                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="state">{{ __('state.form.state') }} </label>
                                            <select class="form-control state-select2" name="state" id="state" data-url="{{ route('get.state') }}" data-clear="" data-target=""  data-rule-required="true" data-msg-required="This field is required" >
                                                @if ($city->state)
                                                    <option value="{{ $city->state->id }}" selected >{{ $city->state->name }}</option>   
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">{{ __('city.form.name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"  data-rule-required="true" value="{{$city->name ?? ''}}" class="form-control">
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


    <script src="{{ asset('assets/admin/js/validation/city-validation.js') }}"></script>

