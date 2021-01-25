@extends('admin.layout.app')

@section('title',__('knowledge_bank.index_title'))

@section('page_title',__('knowledge_bank.index_title'))
@section('button')

    <a class="btn btn-default btn-sm float-right mr-2" href="{{ route('admin.knowledge-bank.index') }}"><i class="fa fa-arrow-left"></i> {{ __('common.back') }}</a>

@endsection


@section('content')
@include('component.error')
<div class="container-fluid">
    <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                     <div class="heading-layout1 p-2">
                        <div class="item-title">
                            <h3>{{ $knowledge_bank->title }}</h3><hr>
                        </div>

{{-- ================================================================================================= --}}

                

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-2">{{ __('knowledge_bank.form.title') }}</dt>
                                        <dd class="col-sm-10"> {{$knowledge_bank->title ?? ''}}</dd>
                                            
                                        <dt class="col-sm-2">Media Type</dt>
                                        
                                        <dd class="col-sm-10">
                                            {{ ( $knowledge_bank->media_type == 1 ) ? 'File' : 'Youtube' }}
                                            <a href="{{ ( $knowledge_bank->media_type == 1 ) ? $knowledge_bank->file : $knowledge_bank->link }}" target="_blank" class="ml-5">{{ ( $knowledge_bank->media_type == 1 ) ? $knowledge_bank->file : $knowledge_bank->link }}</a>
                                        </dd>
                                        

                                        <dt class="col-sm-2">Description</dt>
                                        <dd class="col-sm-10"> {{$knowledge_bank->description ?? ''}}
                                    </dl>
                                </div>

{{-- ================================================================================================= --}}
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div>
@endsection

