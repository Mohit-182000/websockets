<div class="modal fade" id="editcategory" role="dialog" aria-labelledby="editcategory" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">{{ __('category.edit_title') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.category.update',$category->id) }} " method="post" id="categoryForm" name="categoryForm" data-url="{{ route('check.exist') }}">
                        <input type="hidden" name="id" id="id" value="{{ $category->id }}">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                        
                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">{{ __('category.form.name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"  data-rule-required="true" value="{{$category->name ?? ''}}" class="form-control">
                                         </div>

                                        <div class="form-group">
                                            <label for="parent_id">{{ __('category.form.parent_category') }} </label>
                                            <select class="form-control select2" name="parent_id" id="parent_id" data-url="{{ route('get.category') }}" data-clear="" data-target=""   >
                                                <option value="{{ $category->parent_id ?? ''}}" selected>{{ $category->parentCat->name ?? '' }}</option>
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


    <script src="{{ asset('assets/admin/js/validation/category-validation.js') }}"></script>

