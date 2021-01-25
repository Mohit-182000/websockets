@extends('admin.layout.app')

@section('title',__('exam_updates.index_title'))

@section('page_title',__('exam_updates.edit_title'))
@section('button')

    <a class="btn btn-default btn-sm float-right mr-2" href="{{ route('admin.exam-updates.index') }}"><i class="fa fa-arrow-left"></i> {{ __('common.back') }}</a>

@endsection

@section('content')
 @include('component.error')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">


                     <form action="{{ route('admin.exam-updates.update',$exam_updates->id) }}" method="post" id="exam_updatesForm" name="exam_updatesForm" data-url="{{ route('check.exist') }}">
                        <input type="hidden" name="id" id="id" value="{{ $exam_updates->id }}">
                         @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                
                                <div class="form-group ">
                                    <label for="title">{{ __('exam_updates.form.title') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" maxLength="50" id="title" name="title" data-rule-required="true" value="{{$exam_updates->title ?? ''}}">
                                </div>

                                 <div class="form-group ">
                                    <label for="fees">{{ __('exam_updates.form.fees') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="fees" name="fees" data-rule-required="true" data-rule-number="true" value="{{$exam_updates->fees ?? ''}}" >
                                 </div>

                                <div class="form-group">
                                    <label for="lastdate">{{ __('exam_updates.form.lastdate') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control commonDatepicker" id="last_date_of_exam" name="last_date_of_exam" placeholder="dd/mm/yyyy" autocomplete="off" data-rule-required="true" value="{{$exam_updates->last_date_of_exam ?? ''}}">
                                </div>

                                 

                            </div>


                            <div class="col-md-6 col-lg-6 col-xl-6 col-6">

                                  <div class="form-group ">
                                    <label for="no_of_post">{{ __('exam_updates.form.post') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_of_post" name="no_of_post" data-rule-required="true" data-rule-number="true" value="{{$exam_updates->no_of_post ?? ''}}">
                                </div>

                               
                            
                                <div class="form-group">
                                    <label for="age_limit">{{ __('exam_updates.form.age_limit') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="age_limit"  name="age_limit" data-rule-required="true" value="{{$exam_updates->age_limit ?? ''}}" >
                                </div>
                            
                                <div class="form-group">
                                    <label for="link">{{ __('exam_updates.form.link') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="link" name="link" data-rule-required="true" value="{{$exam_updates->link ?? ''}}" >
                                </div>
                           
                            </div>
                                 <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                   
                                    <div class="form-group">
                                        <label for="description">{{ __('exam_updates.form.description') }}<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="description" rows="12" data-rule-required="true"> {{$exam_updates->description ?? ''}}    </textarea>
                                    </div>
                                
                            </div>

                        </div>
                        
                       
                          
                   

                </div>
                <div class="card-footer">
                    <div class="float-right">
                                
                         <button type="submit" data-dismiss="modal" class="btn btn-sm btn-default">{{ __('common.btn_cancel') }}</button>
                        <button type="submit" class="btn btn-save-update btn-sm btn-success">{{ __('common.btn_update') }}</button>
                            
                    </div>
                </div>
            </form>
            
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')

<script src="{{ asset('assets/admin/js/validation/exam_updates-validation.js') }}"></script>

@endpush
