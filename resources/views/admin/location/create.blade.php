<div class="modal fade" id="addlocation" role="dialog" aria-labelledby="addlocation" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">{{ __('location.index_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <div class="modal-body">
                        
                        <form method="post" id="statusForm" name="locationForm">
                        @csrf
                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                         <div class="form-group">
                                            <label for="title_2">{{ __('state.form.state') }} </label>
                                            <select name="state" id="state" data-rule-required="false" class="form-control">
                                                <option value="">Select a State </option>
                                                <option value="1">Gujarat</option>
                                                <option value="2">Tamil Nadu</option>
                                            </select>
                                        </div>

                                         <div class="form-group">
                                            <label for="title_2">{{ __('city.form.city') }} </label>
                                            <select name="city" id="city" data-rule-required="false" class="form-control">
                                                <option value="">Select a City </option>
                                                <option value="1">Rajkot</option>
                                                <option value="2">Chennai</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">{{ __('location.form.name') }}  </label>
                                            <input type="text" name="name" id="name" value="" data-rule-required="false" class="form-control">
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


