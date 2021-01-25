@extends('admin.layout.app')

@section('title',$employer_profile->name)
@section('page_title',$employer_profile->name)

<style>
  .custome_image{
    height: 100px !important;
  }
  
</style>
@push('style')
  <style>
    .kv-file-upload{
        display: none;
    }
    .fa-plus-circle{
        display: none !important;
    }
    .file-drag-handle{
      display: none !important;
    }
  </style>
@endpush
@section('content')
@include('component.error')
<form  action="{{ route('admin.employer.update') }} " enctype="multipart/form-data" method="post" id="employerForm" name="employerForm" >
  @csrf
  <input type="hidden" value="{{ $employer_profile->id }}" name="id">
  <div class="row">
    <div class="col-lg-8 col-xl-8 col-md-8 col-8">
        <div class="row">
          <div class="col-lg-12 col-xl-12 col-md-12 col-12">
            <div class="card card-outline">
              <div class="card-body box-profile">
                
                <div class="row">
                  
                  <div class="col-md-6 form-group">
                    <label for="title">{{ __('employer.form.company_name') }}  <span class="text-danger">*</span> </label>
                    <input type="text" name="company_name" class="form-control" value="{{$employer_profile->name ?? ''}}" data-rule-required="true">
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="title">{{ __('employer.form.company_type') }} <span class="text-danger">*</span> </label>
                    <select class="form-control company-type-select2" name="company_type" id="category" data-url="{{ route('get.company-type') }}" data-clear="" data-target=""  data-rule-required="true">
                      <option value="{{$employer_profile->company_type_id}}" selected>{{$employer_profile->companyType->company_type ?? ''}}</option>
                    </select>
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="title">{{ __('employer.form.mobile') }}  <span class="text-danger">*</span> </label>
                    <input type="text" name="mobile" class="form-control" value="{{$employer_profile->mobile ?? ''}}"  data-rule-number="true" data-rule-required="true" readonly>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="title">{{ __('employer.form.email') }}  </label>
                    <input type="text" name="email" class="form-control" value="{{$employer_profile->email ?? ''}}" >
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="title">{{ __('employer.form.about_company') }} <span class="text-danger">*</span> </label>
                    <textarea name="about_company" class="form-control" rows="4" data-rule-required="true">{{$employer_profile->about_company ?? ''}}</textarea>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="title">{{ __('employer.form.company_address') }} <span class="text-danger">*</span> </label>
                    <textarea name="company_address" class="form-control" rows="4" data-rule-required="true">{{$employer_profile->address ?? ''}}</textarea>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="title">{{ __('employer.form.state') }} <span class="text-danger">*</span> </label>
                    <select class="form-control state-select2" name="state" id="state" data-url="{{ route('get.state') }}" data-clear="#city"  data-rule-required="true">
                      <option value="{{$employer_profile->state_id}}" selected>{{$employer_profile->state->name ?? ''}}</option>
                    </select>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="title">{{ __('employer.form.city') }} <span class="text-danger">*</span> </label>
                    <select class="form-control city-select2" name="city" id="city" data-url="{{ route('get.city') }}" data-clear="#locality" data-target="#state"  data-rule-required="true">
                      <option value="{{$employer_profile->city_id}}" selected>{{$employer_profile->city->name ?? ''}}</option>
                    </select>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="title">{{ __('employer.form.locality') }} <span class="text-danger">*</span> </label>
                    <select class="form-control locality-select2" name="locality" id="locality" data-url="{{ route('get.locality') }}" data-target="#city"  data-rule-required="true">
                      <option value="{{$employer_profile->locality_id}}" selected>{{$employer_profile->locality->name ?? ''}}</option>
                    </select>
                  </div>

                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-12 col-xl-12 col-md-12 col-12">
            <div class="card card-outline">
              <div class="card-header">
                <div class="item-title">
                  <h4>Workspace Photo</h4>
                </div>
              </div>
              <div class="card-body box-profile">
                <div class="file-loading">
                  <input id="input-707" name="workspace_photo[]" data-theme="fas" type="file" multiple>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-xl-4 col-md-4 col-4">
      <div class="card card-outline">
        <div class="card-header">
          <div class="item-title">
            <h4>Company Logo</h4>
          </div>
        </div>
        <div class="card-body box-profile">
          <div class="text-center">
            <img src="{{ asset('storage/profile_image/'.$employer_profile->profile_image) }}" data-default="{{ asset('storage/profile_image/'.$employer_profile->profile_image) }}" id="preview_log" height="150" width="150">
          </div>

          <input type="file" name="company_logo" id="logo" class="file-upload-default" data-rule-extension="jpg,png,jpeg,svg" data-target="#preview_log" data-rule-required="false" data-rule-filesize="5000000" data-msg-required="Image is required." data-msg-filesize="File size must be less than 5mb" style="visibility: hidden;">

          <div class="input-group mb-2">
              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" style="cursor: not-allowed;">

              <span class="input-group-append">
                  <button class="file-upload-browse shadow-sm btn btn-primary" type="button" data-target="#logo">Upload</button>
              </span>
              <span class="input-group-append">
                  <button class="file-upload-clear btn shadow-sm btn-danger" type="button" data-target="#logo">Clear</button>
              </span>

          </div>

          {{-- <span>Note : Image size must be 133 x 35</span> --}}
        </div>
      </div>
    </div>

  </div>
  
  <div class="row">
      <div class="col-md-12">
        <div class="float-right">
          <button type="submit" data-dismiss="modal" class="btn btn-sm btn-default">{{ __('common.btn_cancel') }}</button>
          <button type="submit" class="btn btn-save-update btn-sm btn-success">{{ __('common.btn_update') }}</button>
        </div>
      </div>
  </div>

</form>

<div id="load-modal"></div>


@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/image-preview.js') }}"></script>
<script src="{{ asset('assets/admin/js/validation/employer-validation.js') }}"></script>
@endpush
@push('js')

    <script>
        $(document).ready(function() {
             $("#input-707").fileinput({
                 uploadUrl: false,
                 uploadAsync: false,
                showUpload: false,
                 overwriteInitial: false,
                 initialPreview: [
                  @foreach($employer_profile->user_workspace_photo as $image)
                      '<img class="file-preview-image kv-preview-data" src="{{ asset("storage/workspace_photo/".$image->workspace_photo) }}">',
                  @endforeach
                ],
                 initialPreviewConfig: [
                  @foreach($employer_profile->user_workspace_photo as $image)
                      {caption: "{{$image->workspace_photo}}", url: "{{ url('/admin/workspace_image_delete?image_id='.$image->id)}}"}, 
                  @endforeach
                 ]
             });
             $("#input-707").on("filepredelete", function(jqXHR) {
                 var abort = true;
                 if (confirm("Are you sure you want to delete this image?")) {
                     abort = false;
                 }
                 return abort; 
             });
         });
     </script>
@endpush