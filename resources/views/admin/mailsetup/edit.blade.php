@extends('admin.layout.app')

@section('title' , 'Mailsetup')



@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Mailsetup',
    //'back' =>  route('admin.post-attribute.create') ,
    //'text' => 'Back',
])
@endcomponent
@endsection
@section('content')

<div class="container-fluid">
    
    <form action="{{ route('admin.mailsetup.update' ,1) }}" method="POST" name="mailsetupform" id="mailsetupform" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <div class="row">

            @include('component.error')

            <div class="col-sm-3">
                <h5 class=""><strong>{{ __('mailsetup.index_title') }}</strong></h5>
                <p class="text-muted">{{ __('mailsetup.index_desc') }} </p>
            </div>

            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="mail_host">{{ __('mailsetup.from.mail_driver') }} <span class="text-danger">*</span></label>
                                    <input id="mail_driver" class="form-control" type="text" name="mail_driver"
                                    data-rule-required="true"
                                    data-msg-required="Mail driver is required"
                                    value="{{ $mailsetup->mail_driver ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="mail_host">{{ __('mailsetup.from.mail_host') }} <span class="text-danger">*</span></label>
                                    <input id="mail_host" class="form-control" type="text" name="mail_host"
                                    data-rule-required="true"
                                    data-msg-required="Mail host is required"
                                    value="{{ $mailsetup->mail_host ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="smtp_port">{{ __('mailsetup.from.mail_port') }} <span class="text-danger">*</span></label>
                                    <input id="smtp_port" class="form-control" type="text" name="smtp_port"
                                    data-rule-required="true"
                                    data-msg-required="Mail Port is required"
                                    value="{{ $mailsetup->mail_port ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="smtp_port">{{ __('mailsetup.from.mail_encryption') }} <span class="text-danger">*</span></label>
                                    <input id="mail_encryption" class="form-control" type="text" name="mail_encryption"
                                    data-rule-required="true"
                                    data-msg-required="Mail Encryption is required"
                                    value="{{ $mailsetup->mail_encryption ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="smtp_username">{{ __('mailsetup.from.mail_username') }} <span class="text-danger">*</span></label>
                                    <input id="smtp_username" class="form-control" type="text" name="smtp_username" 
                                    data-rule-required="true"
                                    data-msg-required="Username is required"
                                    value="{{ $mailsetup->mail_username ?? '' }}">
                                </div>
                            </div>
                        </div>
    

                      

               
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="smtp_password">{{ __('mailsetup.from.mail_password') }} <span class="text-danger">*</span></label>
                                    <input id="smtp_password" class="form-control" type="password" name="smtp_password" data-rule-required="true"
                                    data-msg-required="Password is required"
                                    value="{{ $mailsetup->mail_password ?? '' }}">
                                </div>
                            </div>
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

       <!--  <div class="row">
            <div class="col d-flex justify-content-end mb-4">
                <button type="submit" name="save" class="btn btn-success shadow" id="btn_save"> Save</button>
            </div>    
        </div>  -->   
    </form>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/admin/js/setting/mailsetup.js') }}"></script>
@endpush


