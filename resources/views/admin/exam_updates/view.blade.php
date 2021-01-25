@extends('admin.layout.app')

@section('title',__('exam_updates.index_title'))

@section('page_title',__('exam_updates.index_title'))
@section('button')

    <a class="btn btn-default btn-sm float-right mr-2" href="{{ route('admin.exam-updates.index') }}"><i class="fa fa-arrow-left"></i> {{ __('common.back') }}</a>

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
                            <h3>{{__('exam_updates.view_exam')}}</h3><hr>
                        </div>

{{-- ================================================================================================= --}}

                

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <dl class="row">
                                    <dt class="col-sm-2">{{ __('exam_updates.form.title') }}</dt>
                                    <dd class="col-sm-10"> {{$exam_updates->title ?? ''}}</dd>
                                    <dt class="col-sm-2">{{ __('exam_updates.form.post') }}</dt>
                                    <dd class="col-sm-10"> {{$exam_updates->no_of_post ?? ''}}
                                    <dt class="col-sm-2">{{ __('exam_updates.form.fees') }}</dt>
                                    <dd class="col-sm-10"> {{$exam_updates->fees ?? ''}}</dd>
                                    <dt class="col-sm-2">{{ __('exam_updates.form.age_limit') }}</dt>
                                    <dd class="col-sm-10"> {{$exam_updates->age_limit ?? ''}}</dd>
                                    <dt class="col-sm-2">{{ __('exam_updates.form.lastdate') }}</dt>
                                    <dd class="col-sm-10"> {{date('d-m-Y', strtotime($exam_updates->last_date_of_exam)) ?? ''}}</dd>
                                    <dt class="col-sm-2">{{ __('exam_updates.form.link') }}</dt>
                                    <dd class="col-sm-10"> {{$exam_updates->link ?? ''}}</dd>
                                    <dt class="col-sm-2">{{ __('exam_updates.form.description') }}</dt>
                                    <dd class="col-sm-10"> {{$exam_updates->description ?? ''}}</dd>

                                    </dd>
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

