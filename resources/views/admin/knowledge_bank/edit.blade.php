@extends('admin.layout.app')

@section('title',__('knowledge_bank.index_title'))

@section('page_title',__('knowledge_bank.edit_title'))

@section('button')

    <a class="btn btn-default btn-sm float-right mr-2" href="{{ route('admin.knowledge-bank.index') }}"><i class="fa fa-arrow-left"></i> {{ __('common.back') }}</a>

@endsection

@section('content')
 @include('component.error')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                 
                    <form action="{{ route('admin.knowledge-bank.update',$knowledge_bank->id) }}"  method="post"  id="knowledge_bankForm" name="knowledge_bankForm" enctype="multipart/form-data" data-url="{{ route('check.exist') }}">
                        @csrf
                        @method('PUT')
                            <input type="hidden" name="id" id="id" value="{{ $knowledge_bank->id }}">
                            
                            <div class="form-row">

                                <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">{{ __('knowledge_bank.form.title') }}  <span class="text-danger">*</span> </label>
                                            <input type="text" name="title" id="title" maxlength="80"  data-rule-required="false" class="form-control" value="{{$knowledge_bank->title ?? ''}}">
                                        </div>

                                        <div class="form-group">
                                                <label for="doc_yt_link">Type : <span class="text-danger">*</span> &emsp13;</label>

                                                <div class="btn-group pt-2">

                                                    <label class="btn">
                                                        <input class="form-check-input media_type" type="radio" name="media_type" id="media_type" value="1" data-rule-required="true" {{ ($knowledge_bank->media_type == '1') ? 'checked' : '' }}>{{ __('knowledge_bank.form.doc') }}
                                                    </label>
                                                    <label class="btn">
                                                        <input class="form-check-input media_type" type="radio" name="media_type" id="media_type1" value="2" data-rule-required="true" {{ ($knowledge_bank->media_type == '2') ? 'checked' : '' }}>{{ __('knowledge_bank.form.yt') }}
                                                    </label>
                                                    
                                                </div>
                                                <div class="error-div"></div>

                                                <div class="col-xl-6 col-lg-6 col-12 form-group mediaImage2 {{ ($knowledge_bank->media_type == 1) ? '' : 'd-none' }} mg-t-30">
                                                    <input type="file" name="file" id="file" class="form-control-file" data-rule-required="{{isset($knowledge_bank->file) ? 'false' : 'true'}}" data-rule-extension="jpg,jpeg,doc,docx,pdf" data-msg-extension="please select only jpg,jpeg,doc,docx,pdf"
                                                        data-rule-filesize="5242880" data-msg-filesize="File size must be less than 5mb" > {{$knowledge_bank->file ?? ''}}
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-12 form-group mediaYoutube2 {{ ($knowledge_bank->media_type == 2) ? '' : 'd-none' }} mg-t-30">
                                                    <input type="text" name="link" id="link" class="form-control" data-rule-url="true" data-rule-required="true" value="{{$knowledge_bank->link ?? ''}}">                                  
                                                </div>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="description">{{ __('knowledge_bank.form.description') }}  <span class="text-danger">*</span> </label>
                                            <textarea class="form-control" name="description" id="description" rows="12">{{$knowledge_bank->description}}</textarea>
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
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div>

@endsection

@push('js')

    <script type="text/javascript">
        $(document).ready(function() {
            $(".media_type").change(function(){
                var selValue = $("input[type='radio']:checked").val();

                if(selValue==1){ 
                    $('.mediaImage2').removeClass('d-none');
                    $('.mediaYoutube2').addClass('d-none');
                }
                else{
                    $('.mediaImage2').addClass('d-none');
                    $('.mediaYoutube2').removeClass('d-none');
                }
            });
        });
    </script>
        
    <script src="{{ asset('assets/admin/js/validation/knowledge-bank-validation.js') }}"></script>

@endpush






