@extends('admin.layout.app')

@section('title',__('knowledge_bank.index_title'))

@section('page_title',__('knowledge_bank.create_title'))

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

                 
                    <form action="{{ route('admin.knowledge-bank.store') }}" method="post" id="knowledge_bankForm" name="knowledge_bankForm" enctype="multipart/form-data" data-url="{{ route('check.exist') }}">
                        @csrf
                            <div class="form-row">

                                <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">{{ __('knowledge_bank.form.title') }}  <span class="text-danger">*</span> </label>
                                            <input type="text" name="title" maxLength="50" id="title" value="" data-rule-required="true" class="form-control">
                                        </div>

                                        <div class="form-group">
                                                <label for="doc_yt_link">Type : <span class="text-danger">*</span> &emsp13;</label>

                                                <div class="btn-group pt-2">

                                                    <label class="btn">
                                                        <input class="form-check-input media_type" type="radio" name="media_type" id="media_type" value="1" data-rule-required="true">{{ __('knowledge_bank.form.doc') }}
                                                    </label>
                                                    <label class="btn">
                                                        <input class="form-check-input media_type" type="radio" name="media_type" id="media_type1" value="2" data-rule-required="true">{{ __('knowledge_bank.form.yt') }}
                                                    </label>
                                                    
                                                </div>
                                                <div class="error-div form-group"></div>

                                                <div class="col-xl-6 col-lg-6 col-12 form-group mediaImage2 d-none mg-t-30">

                                                    <input type="file" name="file" id="file" class="form-control-file" data-rule-required="true" data-rule-extension="jpg,jpeg,doc,docx,pdf" data-msg-extension="please select only jpg,jpeg,doc,docx,pdf"
                                                        data-rule-filesize="5242880" data-msg-required="Document is required."
                                                        data-msg-filesize="File size must be less than 5mb">

                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-12 form-group mediaYoutube2 d-none mg-t-30">

                                                    <input type="text" name="link" id="link" class="form-control" data-rule-url="true" data-rule-required="true">

                                                </div>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="description">{{ __('knowledge_bank.form.description') }}  <span class="text-danger">*</span> </label>
                                            <textarea class="form-control" name="description" id="description" rows="12"  data-rule-required="true"></textarea>
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

                          $('#file').val(null);
                          $('#link').val(null);
                          
                          if(selValue==1){
                            $('.mediaImage2').removeClass('d-none');
                           $('.mediaYoutube2').addClass('d-none');

                          }else{
                            $('.mediaImage2').addClass('d-none');

                           $('.mediaYoutube2').removeClass('d-none');
                          }
                          // console.log(selValue);
                        });
    });

  
  
</script>
    

<script src="{{ asset('assets/admin/js/validation/knowledge-bank-validation.js') }}"></script>
@endpush



