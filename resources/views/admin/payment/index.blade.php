@extends('admin.layout.app')

@section('title','Payment')

@section('page_title','Payment')
<style>
    .margin_custome{
        padding-top: 30px;
    }
</style>
@section('content')

@include('component.error')

<div class="container-fluid">
    <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">   
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Select User Type </label>           
                            <select class="form-control" data-placeholder="Select User Type" name="user_type" id="UserType">
                                <option value=""></option>
                                <option value="EMPLOYER">Employer</option>
                                <option value="JOBSEEKER">Jobseeker</option>
                            </select>
                        </div>   
                        <div class="col-md-3 form-group margin_custome">
                            <button class="btn btn-danger " type="button" id="btn_clear" name="btn_clear" >Clear</button>
                            <button type="submit" id="search" class="btn btn-success "><i class="fa fa-search"></i>&nbsp;Search</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="heading-layout1 p-2">
                        <div class="item-title">
                            <h3>All Payment</h3>
                        </div>
                    </div>

                    <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

                            <table id="paymentTable" data-url="{{ route('admin.payment.list') }}" class="table table-hover w-100 display nowrap">
                                <tr>
                                    <thead class="gray-light">
                                        <th width="15">{{__('common.id')}}</th>
                                        <th data-orderable="false">User</th>
                                        <th data-orderable="false">Job</th>
                                        <th data-orderable="false">Package</th>
                                        <th data-orderable="false">Subscription date</th>
                                        <th data-orderable="false">Expiry date</th>
                                        <th width="5%" data-orderable="false" >{{__('common.status')}}</th>
                                        <th width="5%" data-orderable="false" class="text-center">{{__('common.action')}}</th>
                                    </thead>
                                </tr>
                                
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div>
<div id="load-modal"></div>
@endsection


@push('js')

<script src="{{asset('assets/admin/js/datatables/payment.js')}}" type="text/javascript"></script>
@endpush
