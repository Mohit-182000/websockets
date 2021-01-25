@extends('admin.layout.app')

@section('title' , $title)
@section('wrapper')
@component('component.heading' , [
'page_title' => 'General',
])
@endcomponent
@endsection

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.settings.store') }}" enctype="multipart/form-data" method="POST" name="general_form" id="general_form" autocomplete="off">
        @csrf

        <div class="row">
            <div class="col-sm-3">
                <h5 class=""><strong>{{ __('setting.site.title') }}</strong></h5>
                <p class="text-muted">{{ __('setting.site.description') }}</p>
            </div>
            <div class="col-sm-9">
                @include('component.error')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="store_name">{{ __('setting.store_name') }} <span class="text-danger">*</span> </label>
                            <input id="store_name" class="form-control" type="text" name="store_name" data-rule-required="true" value="{{ $setting->store_name ?? '' }}" maxlength="190">
                        </div>
                        <div class="form-group">
                            <label for="address_name">{{ __('setting.address') }} <span class="text-danger">*</span>
                            </label>
                            <textarea id="address_name" class="form-control" type="text" name="address_name" data-rule-required="true" rows="5" maxlength="190">{{ $setting->address_name ?? '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="address_email">{{ __('setting.email') }}
                                        <span class="text-danger">*</span></label>
                                    <input id="address_email" class="form-control" type="email" name="address_email" data-rule-required="true" value="{{ $setting->address_email ?? '' }}" maxlength="190">
                                </div>

                                <div class="col">
                                    <label for="address_contact_us">{{ __('setting.contact_us') }} <span class="text-danger">*</span>
                                    </label>
                                    <input id="address_contact_us" class="form-control" type="text" name="address_contact_us" data-rule-required="true" value="{{ $setting->address_contact ?? '' }}" maxlength="10" data-rule-number=”true”>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            {{-- <div class="col">
                                <div class="form-group">
                                    <label for="country">{{ __('setting.country') }} <span class="text-danger">*</span> </label>

                                    <select class="form-control select-change country-select2" style="width:100%" name="country" id="country" data-rule-required="true" data-url="{{ route('get.country') }}" data-clear="#city_id,#state" {{ __('setting.country.placeholder') }} data-rule-required="true">
                                        @if ($setting->country)
                                        <option value="{{ $setting->country->id }}" selected>
                                            {{ $setting->country->name }}</option>
                                        @endif
                                    </select>

                                </div>
                            </div> --}}
                            <div class="col">
                                <div class="form-group">
                                    <label for="state"> {{ __('setting.state') }}<span class="text-danger">*</span></label>
                                    <select id="state" name="state" id="state" data-rule-required="true" style="width:100%" data-url="{{ route('get.state') }}" data-target="#country" data-clear="#city_id" data-placeholder="{{ __('setting.state.placeholder') }}" class="selectpicker form-control state-select2 select-change">
                                        
                                        @if ($setting->state)
                                        <option value="{{ $setting->state->id }}" selected>{{ $setting->state->name }}
                                        </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="city_id">{{ __('setting.city') }} <span class="text-danger">*</span>
                                    </label>
                                    <select id="city_id" name="city_id" data-rule-required="true" style="width:100%;" data-url="{{ route('get.city') }}" data-target="#state" data-msg-required="City is required" data-placeholder="{{ __('setting.city.placeholder') }}" class="selectpicker form-control city-select2">
                                        @if($setting->city)
                                        <option value="{{ $setting->city->id }}" selected>{{ $setting->city->name }}
                                        </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postal_code">
                                        {{ __('setting.pin_code') }} <span class="text-danger">*</span> </label>
                                    <input id="postal_code" class="form-control" type="text" name="postal_code" data-rule-required="true" value="{{  $setting->pincode ?? '' }}" data-rule-minlength="6" data-rule-maxlength="6">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="favicon" class="form-control-label">{{ __('setting.favicon') }}
                                            :</label><br>

                                        <div class="">
                                            <img src="{{ $setting->favicon_image }}" data-default="{{ $setting->favicon_image }}" id="preview_favicon" height="35">
                                        </div>

                                        <input type="file" name="favicon" id="favicon" class="file-upload-default" data-rule-extension="jpg,png,jpeg,svg" data-target="#preview_favicon" data-rule-required="false" data-rule-filesize="5000000" data-msg-required="Image is required." data-msg-filesize="File size must be less than 5mb" style="visibility: hidden;">

                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" style="cursor: not-allowed;">

                                            <span class="input-group-append">
                                                <button class="file-upload-browse shadow-sm btn btn-primary" type="button" data-target="#favicon">Upload</button>
                                            </span>
                                            <span class="input-group-append">
                                                <button class="file-upload-clear btn shadow-sm btn-danger" type="button" data-target="#favicon">Clear</button>
                                            </span>

                                        </div>

                                        <span>Note : Image size must be 33 x 35</span>
                                    </div>
                                </div>

                            </div>


                            <div class="col">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="logo" class="form-control-label">{{ __('setting.logo') }}
                                            : </label><br>

                                        <div class="">
                                            <img src="{{ $setting->logo_image }}" data-default="{{ $setting->logo_image }}" id="preview_log" height="35">
                                        </div>

                                        <input type="file" name="logo" id="logo" class="file-upload-default" data-rule-extension="jpg,png,jpeg,svg" data-target="#preview_log" data-rule-required="false" data-rule-filesize="5000000" data-msg-required="Image is required." data-msg-filesize="File size must be less than 5mb" style="visibility: hidden;">

                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" style="cursor: not-allowed;">

                                            <span class="input-group-append">
                                                <button class="file-upload-browse shadow-sm btn btn-primary" type="button" data-target="#logo">Upload</button>
                                            </span>
                                            <span class="input-group-append">
                                                <button class="file-upload-clear btn shadow-sm btn-danger" type="button" data-target="#logo">Clear</button>
                                            </span>

                                        </div>

                                        <span>Note : Image size must be 133 x 35</span>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="offers">{{  __('setting.offers') }}</label>
                        <textarea rows="7" name="offers_slider" id="offers_slider" class="form-control">{{ $setting->offers_slider ?? '' }}</textarea>
                    </div>
                    <label>
                        <span class="text-danger">Note: You can separate by ##(Double Hash Sign) (E.X. Terms 1##Terms 2##Terms 3)
                        </span>
                    </label>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="offers">{{ __('setting.offers_single') }}</label>
                        <textarea rows="4" name="offers" id="offers" class="form-control">{{ $setting->offers ?? '' }}</textarea>
                    </div>
                </div>--}}

            </div>

        </div>

</div>

</div>
<div class=" row">
    <div class="col-sm-3">
        <h5 class=""><strong>Salary Limit</strong></h5>
    </div>

    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Minimum Salary</label>
                        <input type="number" class="form-control" name="minimum_salary" value="{{ $setting->minimum_salary ?? '' }}" placeholder="Minimum Salary" data-rule-number="true"  data-rule-maxlength="6" min="0" data-rule-required="true">    
                    </div>    
                    <div class="col-md-6">
                        <label>Maximum Salary</label>
                        <input type="number" class="form-control" name="maximum_salary" value="{{ $setting->maximum_salary ?? ''}}" placeholder="Maximum Salary" data-rule-number="true" data-rule-maxlength="6" min="0" data-rule-required="true">    
                    </div>    
                </div>
            </div>
        </div>

    </div>

</div>
<div class=" row">
    <div class="col-sm-3">
        <h5 class=""><strong>Socialite</strong></h5>
        <p class="text-muted">{{ __('setting.social_media.description') }}.</p>
    </div>
    @php
    $social = json_decode($setting->social)

    @endphp

    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">

                <div class="form-group">
                    <div class="input-group input-group-default">
                        <span class="input-group-prepend"><label class="input-group-text"><i class="fab fa-facebook"></i></label></span>
                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{ $social->facebook ?? '' }}" data-rule-url=”true”>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group input-group-default">
                        <span class="input-group-prepend"><label class="input-group-text"><i class="fab fa-twitter"></i></label></span>

                        <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $social->twitter ??'' }}" data-rule-url=”true”>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-default">
                        <span class="input-group-prepend"><label class="input-group-text"><i class="fab fa-youtube"></i></label></span>
                        <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $social->youtube ?? '' }}" data-rule-url=”true”>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-default">
                        <span class="input-group-prepend"><label class="input-group-text"><i class="fab fa-instagram ml-1"></i></label></span>

                        <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $social->instagram ?? '' }}" data-rule-url=”true”>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-default">
                        <span class="input-group-prepend"><label class="input-group-text"><i class="fab fa-linkedin ml-1"></i></label></span>
                        <input type="text" class="form-control" id="linkin" name="linkin" value="{{ $social->linkedin ?? '' }}" data-rule-url=”true”>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
<div class=" row">
    <div class="col-sm-3">
        <h5 class=""><strong>Terms And Conditions</strong></h5>
    </div>

    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <textarea class="ckeditor" name="terms_and_condition">{{ $setting->terms_and_condition ?? '' }}</textarea>
            </div>
        </div>

    </div>

</div>
<div class=" row">
    <div class="col-sm-3">
        <h5 class=""><strong>Privacy Policy</strong></h5>
    </div>

    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <textarea class="ckeditor" name="privacy_policy">{{ $setting->privacy_policy ?? '' }}</textarea>
            </div>
            <div class="card-footer">
                <div class="float-right">

                    <button type="submit" class="btn btn-sm btn-success">Save</button>

                </div>
            </div>
        </div>

    </div>

</div>
<div class="row d-none">
    <div class="col-sm-3">
        <h5 class=""><strong>{{ __('setting.personalize.title') }}</strong></h5>
        <p class="text-muted">{{ __('setting.personalize.description') }}.</p>
    </div>
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ __('setting.date_format') }} : </label>
                            @foreach($site_date_format as $dkey => $site_date_format_val)
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="{{$dkey}}" {{
                                                           $setting->site_date_format == $site_date_format_val ? 'checked' : ''
                                                       }} name="site_date_format" value="{{$site_date_format_val}}">

                                <label for="{{$dkey}}" class="custom-control-label" style="font-weight: 500;">{{$site_date_format_val}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="form-row d-none">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>{{ __('setting.time_zone') }}: </label>
                            <select name="timezone" id="timezone" class="form-control">
                                <option value="">Select a timezone</option>
                                @foreach (timezone_identifiers_list() as $key=> $timezone)


                                <option value="{{ $timezone }}" {{ ($timezone == $setting->time_zone) ? 'selected':'' }}>{{ $timezone }}
                                </option>

                                @endforeach
                            </select>

                        </div>

                    </div>

                </div>
                <div class="form-row d-none">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label>{{ __('setting.currency') }} : </label>
                            <select name="currency_symbol" id="currency_symbol1" data-placeholder="{{ __('setting.currency.placeholder') }}" class="form-control">
                                <option value="">Select a currency</option>
                                @foreach($currency_list as $key=> $currency)

                                <option value="{{ $currency->id }}" {{ ( $currency->id == $setting->currency_symbol) ? 'selected' : '' }}>
                                    {{ $currency->country }} ({{ $currency->code }})
                                    : {{ $currency->symbol }}
                                </option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('setting.format') }} : </label>
                            <select class="form-control " data-placeholder="{{ __('setting.format.placeholder') }}" name="currency_format" id="currency_format">
                                <option value="">Select format a currency</option>
                                <option value="right" {{ ( $setting->currency_format=='right') ? 'selected' : '' }}>Right
                                    (100$)
                                </option>
                                <option value="right_space" {{ ( $setting->currency_format=='right_space') ? 'selected' : '' }}>
                                    Right
                                    with space (100 $)
                                </option>
                                <option value="left" {{ ( $setting->currency_format=='left') ? 'selected' : '' }}>Left ($100)
                                </option>
                                <option value="left_space" {{ ( $setting->currency_format=='left_space') ? 'selected' : '' }}>Left
                                    with
                                    space ($ 100)
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('setting.thousand_separator') }} : </label>
                            <input type="text" name="thousan_separator" class="form-control" value="{{ $setting->thousan_separator}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('setting.decimal_separator') }} : </label>
                        <div class="form-group">
                            <input type="text" name="decimal_separator" class="form-control" value="{{ $setting->decimal_separator}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('setting.no_of_decimal') }} : </label>
                        <div class="form-group">
                            <input type="number" name="no_of_decimal" class="form-control" value="{{ $setting->no_of_decimal}}" data-rule-number=”true” data-msg-maxlength="Please enter a value less than or equal to 4." maxlength="1" min="0" max="4" pattern="\d*">
                        </div>
                    </div>`

                </div>

            </div>
        </div>

    </div>

</div>
<div class="row d-none">
    <div class="col-sm-3">
        <h5 class=""><strong> {{ __('setting.invoice.title') }} Invoice</strong></h5>
        <p class="text-muted">{{ __('setting.invoice.description') }} .</p>
    </div>
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="prefix"> {{ __('setting.invoice_prefix') }} <i class="text-danger">*</i></label>
                        <input type="text" name="prefix" id="prefix" class="form-control" value="{{ $setting->prefix ?? ''}}" data-rule-required="true" data-msg-required="This field is required.">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="invoice_no"> {{ __('setting.next_invoice_number') }} </label>
                        <input type="text" readonly="true" name="invoice_no" id="invoice_no" class="form-control" value="{{$setting->invoice_no ?? ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="invoice_formet" class="form-control-label"> {{ __('setting.invoice_format') }} </label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="format1" name="invoice_formet" value="1" {{(!empty($setting->invoice_formet) && $setting->invoice_formet=='Number Based')?'checked':''}}>
                        <label for="format1" class="custom-control-label" style="font-weight: 400;">Number
                            Based(00001)</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="format2" name="invoice_formet" value="2" {{(!empty($setting->invoice_formet) && $setting->invoice_formet=='Year Based')?'checked':''}}>
                        <label for="format2" class="custom-control-label" style="font-weight: 400;">Year
                            Based(YYYY/00001)</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="format3" name="invoice_formet" value="3" {{(!empty($setting->invoice_formet) && $setting->invoice_formet=='00001-YY')?'checked':''}}>
                        <label for="format3" class="custom-control-label" style="font-weight: 400;">00001-YY</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="format4" name="invoice_formet" value="4" {{(!empty($setting->invoice_formet) && $setting->invoice_formet=='00001/MM/YY')?'checked':''}}>
                        <label for="format4" class="custom-control-label" style="font-weight: 400;">00001/MM/YY</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--   <div class="row">
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
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/location.js') }}"></script>
<script src="{{ asset('assets/admin/js/image-preview.js') }}"></script>
<script src="{{ asset('assets/admin/js/setting.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/ckeditor/ckeditor.js') }}"></script>
@endpush