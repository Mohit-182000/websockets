@extends('admin.layout.app')

@section('title',__('user.index_title'))

@section('page_title',__('user.create_title'))
@section('button')

    <a class="btn btn-default btn-sm float-right mr-2" href="{{ route('admin.user.index') }}"><i class="fa fa-arrow-left"></i> {{ __('common.back') }}</a>

@endsection

@section('content')
 @include('component.error')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">


                     <form action="{{ route('admin.user.store') }}" method="post" id="userForm" name="userForm" enctype="multipart/form-data" data-url="{{ route('check.exist') }}">
                        @csrf
                        <div class="form-row">
                           
                                 <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">{{ __('user.form.name') }} <span class="text-danger">*</span> </label>
                                            <input type="text" name="name" id="name" value="" data-rule-required="true" class="form-control">
                                         </div>

                                        <div class="form-group">
                                            <label for="email">{{ __('user.form.email') }} <span class="text-danger">*</span> </label>
                                            <input type="text" name="email" id="email" value="" data-rule-required="true" class="form-control">
                                         </div>

                                        <div class="form-group">
                                            <label for="file">{{ __('user.form.profile') }} <span class="text-danger">*</span> </label>
                                            <input type="file" name="file" id="file" value="" data-rule-required="true" class="form-control">
                                         </div>

                                        <div class="form-group">
                                            <label>{{ __('user.form.cpwd') }} <span class="text-danger">*</span> </label>
                                            <input type="password" name="password" id="password" value="" data-rule-required="true" data-rule-minlength="8" class="form-control">
                                         </div>

                                        <div class="form-group">
                                            <label>{{ __('user.form.password') }} <span class="text-danger">*</span> </label>
                                            <input type="password" name="confirm_password" value="" data-rule-required="true" data-rule-minlength="8" data-rule-equalTo="#password" class="form-control">
                                         </div>
                                            
                                    </div>
                        </div>
                        
                       
                          
                   

                </div>
                <div class="card-footer">
                    <div class="float-right">
                                
                         <button type="submit" data-dismiss="modal" class="btn btn-sm btn-default">{{ __('common.btn_cancel') }}</button>
                        <button type="submit" class="btn btn-save-update btn-sm btn-success">{{ __('common.btn_save') }}</button>
                            
                    </div>
                </div>
            </form>
            
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')

<script src="{{ asset('assets/admin/js/validation/user-validation.js') }}"></script>

@endpush

