@extends('admin.layout.app')

@section('title' , $title)
@section('wrapper')
    @component('component.heading' , [
        'page_title' => 'Terms & Conditions',
    ])
    @endcomponent
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.term.store') }}" enctype="multipart/form-data" method="POST"
              name="general_form"
              id="general_form" autocomplete="off">
            @csrf

            <div class="row">
                <div class="col-sm-3">
                    <h5 class=""><strong>Terms & Conditions</strong></h5>
                    <p class="text-muted"></p>
                </div>
                <div class="col-sm-9">
                    @include('component.error')
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="term_condition">Terms & Conditions <span
                                        class="text-danger">*</span> </label>
                              <textarea name="term_condition" id="term_condition" class="form-control">
                                  {{ $setting->term_condition ?? ''}}
                              </textarea>
                            </div>
                         

                           
                         

                          
                           


                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                              
                               
                                   
                               
                                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                               
                            </div>
                        </div>
                    </div>

                </div>

            </div>
          
          
         

            <!-- <div class="row">
                <div class="col d-flex justify-content-end mb-4">
                    <button type="submit" name="save" class="btn btn-save-update btn-success shadow">
                        <span id="sid" role="status" aria-hidden="true"></span> {{ __('common.btn_save') }} </button>
                </div>
            </div> -->

        </form>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/location.js') }}"></script>
    <script src="{{ asset('assets/admin/js/image-preview.js') }}"></script>
    <script src="{{ asset('assets/admin/js/setting.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
         CKEDITOR.replace( 'term_condition' );
    </script>
@endpush
