<div class="modal fade" id="editskills" role="dialog" aria-labelledby="editskills" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">{{ __('skills.edit_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>


                    <form action="{{ route('admin.skills.update',$skill->id) }} " method="post" id="skillsForm" name="skillsForm" data-url="{{ route('check.exist') }}">
                        <input type="hidden" name="id" id="id" value="{{ $skill->id }}">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                        
                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="category">{{ __('category.form.category') }} <span class="text-danger">*</span></label>
                                            <select class="form-control category-select2" name="category[]" id="category" data-url="{{ route('get.category') }}" data-clear="" data-target=""  data-rule-required="true" data-msg-required="This field is required" multiple>
                                                <?php $data = $skill->category->pluck('name','id'); ?>
                                                @foreach($data as $id => $value)
                                                    <option  value="{{ $id }}" selected>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    

                                        <div class="form-group">
                                            <label for="title">{{ __('skills.form.name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"  data-rule-required="true" value="{{$skill->name ?? ''}}" class="form-control">
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


    <script src="{{ asset('assets/admin/js/validation/skills-validation.js') }}"></script>

