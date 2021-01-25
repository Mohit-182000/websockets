@extends('admin.layout.app')

@section('title',$job_post->job_title)
@section('page_title',$job_post->job_title)

<style>
  .custome_image{
    height: 100px !important;
  }
  
</style>

@section('content')
@include('component.error')
<form  action="{{ route('admin.job_post.update') }} " enctype="multipart/form-data" method="post" id="jobPostForm" name="jobPostForm" >
  @csrf
  <input type="hidden" value="{{ $job_post->id }}" name="id">
  <div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-12">
      <div class="card card-outline">
        <div class="card-body box-profile">
          <div class="row">

            <div class="col-md-12 form-group">
              <label>{{ __('job_post.form.job_title') }} <span class="text-danger">*</span></label>
              <input type="text" class="form-control" value="{{ $job_post->job_title }}" name="job_title" data-rule-required="true" data-rule-maxlength="150">
            </div>

            <div class="col-md-12 form-group">
              <label>{{ __('job_post.form.job_description') }}</label>
              <textarea name="job_description" class="form-control">{{ $job_post->job_description }}</textarea>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.job_category') }} <span class="text-danger">*</span></label>
              <select class="form-control category-select2" name="job_category[]" id="category" data-clear="#skill" data-url="{{ route('get.category') }}" data-clear="" data-target=""  data-rule-required="true" multiple>
                @php $data = $job_post->category->pluck('name','id'); @endphp

                @foreach($data as $id => $value)
                    <option  value="{{ $id }}" selected>{{ $value }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.job_location') }} <span class="text-danger">*</span></label>
              <input type="text" class="form-control" value="{{ $job_post->location }}"" name="job_location" data-rule-required="true">
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.gender') }} <span class="text-danger">*</span></label>
              <div class="row">
                <div class="col-md-6 pl-5 custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="male" value="M" name="gender[]" data-rule-required="true" {{ ($job_post->gender == 'M' || $job_post->gender == 'M,F' || $job_post->gender == 'F,M') ? 'checked' : ''}}>
                  <label for="male" class="custom-control-label">Male</label>
                </div>
                
                <div class="col-md-6 pr-6 custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="female" value="F" name="gender[]" {{ ($job_post->gender == 'F' || $job_post->gender == 'M,F' || $job_post->gender == 'F,M') ? 'checked' : ''}}>
                  <label for="female" class="custom-control-label">Female</label>
                </div>
              </div>
              <div class="pl-3 error-div"></div>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.job_type') }} <span class="text-danger">*</span></label>
              <div class="row">
                @foreach($job_type as $data)
                  <div class="col-md-3 pl-5 custom-control custom-checkbox">
                    <input class="custom-control-input" name="job_type[]" type="checkbox" id="JobType{{$data->id}}" value="{{$data->id}}" data-rule-required="true" {{ ($job_post->job_type()->where('job_type_id',$data->id)->exists()) ? 'checked' : '' }}>
                    <label for="JobType{{$data->id}}" class="custom-control-label">{{ $data->name }}</label>
                  </div>
                @endforeach
                
              </div>
              <div class="pl-3 error-div"></div>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.minimum_salary') }} <span class="text-danger">*</span></label>
              <input type="text" class="form-control" value="{{ $job_post->minimum_salary }}" name="minimum_salary" data-rule-required="true" data-rule-number="true" data-rule-maxlength="150">
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.maximum_salary') }} <span class="text-danger">*</span></label>
              <input type="text" class="form-control" value="{{ $job_post->maximum_salary }}" name="maximum_salary" data-rule-required="true" data-rule-number="true" data-rule-maxlength="150">
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.experience') }} <span class="text-danger">*</span></label>
              <select class="form-control category-select2" name="experience" data-url="{{ route('get.experience') }}" data-rule-required="true">
                <option value="{{ $job_post->experience_id}}" selected>{{ $job_post->experience->name ?? '' }}</option>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.skill') }} <span class="text-danger">*</span> </label>
              <select class="form-control category-select2" name="skill[]" id="skill" data-target="#category" data-url="{{ route('get.skill') }}"  data-rule-required="true" multiple>
                @php $data = $job_post->skill->pluck('name','id'); @endphp

                @foreach($data as $id => $value)
                    <option  value="{{ $id }}" selected>{{ $value }}</option>
                @endforeach
              </select>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.qualification') }} </label>
              <select class="form-control category-select2" name="qualification[]" data-url="{{ route('get.qualification') }}" multiple>
                @php $data = $job_post->qualification->pluck('name','id'); @endphp

                @foreach($data as $id => $value)
                    <option  value="{{ $id }}" selected>{{ $value }}</option>
                @endforeach
              </select>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.known_languages') }} </label>
              <select class="form-control category-select2" name="known_languages[]" data-url="{{ route('get.known-languages') }}"  multiple>
                @php $data = $job_post->known_languages->pluck('name','id'); @endphp

                @foreach($data as $id => $value)
                    <option  value="{{ $id }}" selected>{{ $value }}</option>
                @endforeach
              </select>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.shift') }} </label>
              <select class="form-control category-select2" name="shift[]" data-url="{{ route('get.shift') }}"   multiple>
                @php $data = $job_post->shift->pluck('name','id'); @endphp

                @foreach($data as $id => $value)
                    <option  value="{{ $id }}" selected>{{ $value }}</option>
                @endforeach
              </select>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.marital_status') }} </label>
              <select class="form-control category-select2" name="marital_status[]" data-url="{{ route('get.marital-status') }}"  multiple>
                @php $data = $job_post->marital_status->pluck('name','id'); @endphp

                @foreach($data as $id => $value)
                    <option  value="{{ $id }}" selected>{{ $value }}</option>
                @endforeach
              </select>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.state') }} <span class="text-danger">*</span></label>
              <select class="form-control state-select2" name="state" data-url="{{ route('get.state') }}" id="State" data-clear="#City" data-rule-required="true">
                <option value="{{ $job_post->state_id}}" selected>{{ $job_post->state->name ?? '' }}</option>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.city') }} <span class="text-danger">*</span></label>
              <select class="form-control city-select2" name="city" id="City" data-url="{{ route('get.city') }}" data-target="#State" data-rule-required="true">
                <option value="{{ $job_post->city_id}}" selected>{{ $job_post->city->name ?? '' }}</option>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.no_position') }} <span class="text-danger">*</span></label>
              <input type="text" class="form-control" value="{{ $job_post->vacancy }}" name="no_position" data-rule-required="true" data-rule-number="true" data-rule-maxlength="10">
            </div>

            <div class="col-md-6 form-group">
              <label>{{ __('job_post.form.age_restriction') }} <span class="text-danger">*</span></label>
              <div class="row">
                <div class="col-md-6 pl-5 custom-control custom-radio">
                  <input class="custom-control-input is_age_limit" type="radio" id="no" value="" name="is_age_limit" {{ ($job_post->is_age_limit == null) ? 'checked' : ''}}>
                  <label for="no" class="custom-control-label">No</label>
                </div>
                
                <div class="col-md-6 pr-6 custom-control custom-radio">
                  <input class="custom-control-input is_age_limit" type="radio" id="yes" value="1" name="is_age_limit" {{ ($job_post->is_age_limit == 1) ? 'checked' : ''}}>
                  <label for="yes" class="custom-control-label">Yes</label>
                </div>
              </div>
            </div>

            <div class="col-md-6 form-group age_limit" @if($job_post->is_age_limit != 1) style="display: none;" @endif>
              <label>{{ __('job_post.form.limit') }} <span class="text-danger">*</span></label>
              <input type="text" class="form-control" value="{{ $job_post->age_limit }}" name="age_limit" data-rule-required="true" data-rule-number="true" data-rule-maxlength="50">
            </div>

          </div>
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
<script src="{{ asset('assets/admin/js/validation/job_post-validation.js') }}"></script>

<script>
  $('.is_age_limit').on('click',function(){
    var value = $(this).val();
    
    if(value == ''){
      $('.age_limit').hide();
    }

    if(value == 1){
      $('.age_limit').show();
    }
  });
</script>
@endpush
