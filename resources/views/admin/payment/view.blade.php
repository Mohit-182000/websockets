@extends('admin.layout.app')

@section('title','Paymnet')

@section('page_title','Paymnet')
@section('button')

    <a class="btn btn-default btn-sm float-right mr-2" href="{{ route('admin.payment.index') }}"><i class="fa fa-arrow-left"></i> {{ __('common.back') }}</a>

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
                            <h3>Payment Details</h3><hr>
                        </div>

{{-- ================================================================================================= --}}

                

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-2">User</dt>
                                        <dd class="col-sm-10"> {{$payment->user->name ?? ''}}</dd>

                                        <dt class="col-sm-2">Job</dt>
                                        <dd class="col-sm-10"> {{$payment->job->job_title ?? ''}}</dd>

                                        <dt class="col-sm-2">Package</dt>
                                        <dd class="col-sm-10"> {{$payment->package->name ?? ''}}</dd>

                                        <dt class="col-sm-2">Status</dt>
                                        <dd class="col-sm-10"> {{$payment->status ?? ''}}</dd>

                                        <dt class="col-sm-2">Payment ID</dt>
                                        <dd class="col-sm-10"> {{$payment->payment_id ?? ''}}</dd>
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

