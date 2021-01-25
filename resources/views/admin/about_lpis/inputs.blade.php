<div class="card">
    <div class="card-body">
        <div class="row">
            @include('component.error')
        </div>
        <div class="row">
            <div class="col-md-12  pr-3">
                <div class="form-group">
                    <label for="title">{{ __('banner.from.title') }} 1 </label>
                    <input type="text" name="title" id="title"          
                        value="{{ $banner->title ?? null }}" data-rule-required="false" class="form-control">
                </div>

                <div class="form-group">
                    <label for="title_2">Title 2 </label>
                    <input type="text" name="title_2" id="title_2"          
                        value="{{ $banner->title_2 ?? null }}" data-rule-required="false" class="form-control">
                </div>


              {{--<div class="form-group">
                    <label for="">{{ __('banner.from.description') }} <i class="text-danger">*</i></label>
                    <textarea data-rule-required="true" class="form-control" name="description" id="description"  >{{ $banner->content ?? null }}</textarea>


                </div>

                 <div class="form-group">
                    <label for="">{{ __('banner.from.btn_name') }}</label>
                    <input type="text" name="btn_name" id="btn_name"          
                        value="{{ $banner->btn_name ?? null }}"  class="form-control">
                </div>

                 <div class="form-group">
                    <label for="">{{ __('banner.from.btn_url') }} </label>
                    <input type="text" name="btn_url" id="btn_url" data-rule-url="true"          
                        value="{{ $banner->btn_url ?? null }}"  class="form-control">
                </div>--}}
              {{--   <div class="form-group">
                                    <h6><strong>Button Position</strong></h6>
                                    <hr>
                                 
                        <div class="row ml-1">
                                               
                          <div class="custom-control custom-radio">

                              <input class="custom-control-input" type="radio"  name="btn_position" value="Left" id="customRadio1" @if(isset($banner)) {{ $banner->btn_position == 'Left' ? 'checked' : '' }} @endif>
                              <label for="customRadio1" class="custom-control-label">Left</label>
                          
                        
                          </div>

                         <div class="custom-control custom-radio ml-3">
                               <input class="custom-control-input" type="radio" name="btn_position" value="Center" id="customRadio2" @if(isset($banner)) {{ $banner->btn_position == 'Center' ? 'checked' : '' }}  @endif>
                               <label for="customRadio2" class="custom-control-label">Center</label>
                         </div>

                         <div class="custom-control custom-radio ml-3">

                               <input class="custom-control-input" type="radio" name="btn_position" value="Right" id="customRadio3" @if(isset($banner)) {{ $banner->btn_position == 'Right' ? 'checked' : '' }} @endif>
                              <label for="customRadio3" class="custom-control-label">Right</label>

                        </div>

                        </div>

                                   
                  </div>--}}
                
               
                
                <div class="form-group">
                       
                    <label for="">{{ __('banner.from.image') }} <i class="text-danger">*</i></label>
                        <div class="">

                            <img
                                data-rule-required="true"
                                src="{{ $banner->banner_image ?? asset('storage/default/picture.png') }}"        
                                data-default="{{ $banner->banner_image ?? asset('storage/default/picture.png') }}" 
                                id="preview_favicon"
                                height="35">
                        </div>

                    <input type="file" name="image" id="image" class="file-upload-default"
                        
                        data-target="#preview_favicon" data-rule-required="{{ isset($banner) ? 'false' : 'true' }}" 
                        data-rule-extension="jpg,png,jpeg"
                        data-rule-filesize="5000000" data-msg-required="Image is required."
                        data-msg-filesize="File size must be less than 5mb"
                        style="visibility: hidden;">

                    <div class="input-group mb-2 w-50">
                        <input type="text" class="form-control file-upload-info" disabled=""
                            placeholder="Upload Image" style="cursor: not-allowed;">

                        <span class="input-group-append">
                            <button class="file-upload-browse shadow-sm btn btn-primary"
                                type="button" data-target="#image">Upload</button>
                        </span>
                        <span class="input-group-append">
                            <button class="file-upload-clear btn shadow-sm btn-danger" type="button"
                                data-target="#image">Clear</button>
                        </span>
                    </div>
                    <span>{{ __('banner.image_note') }}</span>
                    <div class="error-div"></div>

                </div>
                
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="float-right">
            <a href="{{ route('admin.homepagebanners.index') }}" class="btn btn-sm btn-default">{{ __('common.btn_cancel') }}</a>
            @if (isset($banner))
                <button type="submit" class="btn btn-save-update btn-sm btn-success">{{ __('common.btn_update') }}</button>
            @else
                <button type="submit" class="btn btn-save-update btn-sm btn-success">{{ __('common.btn_save') }}</button>
            @endif
        </div>
    </div>
</div>
