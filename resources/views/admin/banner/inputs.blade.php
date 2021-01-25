<div class="card">
    <div class="card-body">
        <div class="row">
            @include('component.error')
        </div>
        <div class="row">
            <div class="col-md-12">
                
                <div class="form-group">
                       
                    <label for="">{{ __('banner.from.image') }} <i class="text-danger">*</i></label>
                        <div class="">

                            <img
                                data-rule-required="true"
                                src="{{ $banner->banner_image ?? asset('storage/default/picture.png') }}"        
                                data-default="{{ $banner->banner_image ?? asset('storage/default/picture.png') }}" 
                                id="preview_favicon"
                                height="100">
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
