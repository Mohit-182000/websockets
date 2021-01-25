@extends('admin.layout.app')

@section('title',__('employer.index_title'))

@section('page_title',__('employer.index_title'))

<style>
    .page-link{
        height: 100%;
    }
    .dt-buttons{
        margin-top: -45px;
    }
</style>

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h3>Filter</h3>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Company Type </label>           
                            <select class="form-control select2companytype" data-placeholder="Search Company Type" data-url="{{ route('get.company-type') }}" name="company_type" id="companyType"></select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Industries </label>           
                            <select class="form-control select2" data-placeholder="Search Industries" data-url="{{ route('get.industries') }}" name="industries" id="industries"></select>
                        </div>  
                        <div class="col-md-3 form-group">
                            <label>Category </label>           
                            <select class="form-control select2" data-placeholder="Search Category" data-url="{{ route('get.category') }}" name="category" id="category"></select>
                        </div>   
                        <div class="col-md-3 form-group">
                            <label>City </label>           
                            <select class="form-control select2" data-placeholder="Search City" data-url="{{ route('get.city') }}" name="city" id="city"></select>
                        </div>    
                        <div class="col-md-3 form-group">
                            <button class="btn btn-danger " type="button" id="btn_clear" name="btn_clear" >Clear</button>
                            <button type="submit" id="search" class="btn btn-success "><i class="fa fa-search"></i>&nbsp;Search</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

                            <div class="heading-layout1 p-2">
                                <div class="item-title">
                                    <h3>All Employer</h3>
                                    <div id="buttons" class="float-right"></div>
                                </div>
                            </div>

                                <table id="employerPostTable" data-url="{{ route('admin.employer.list') }}" class="table table-hover w-100 display nowrap ">
                                     <tr>
                                        <thead class="gray-light">
                                            <th width="15">{{__('common.id')}}</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th data-orderable="false">Number <br>of Job Post</th>
                                            <th data-orderable="false">Applied number <br> of candidates</th>
                                            <th width="15%" data-orderable="false" class="text-center">{{__('common.status')}}</th>
                                            <th width="5%" data-orderable="false" class="text-center">{{__('common.action')}}</th>
                                            <th width="5%" data-orderable="false" class="text-center">Chat</th>
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


@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    

    <script src="{{asset('assets/admin/js/datatables/employer-datatable.js')}}" type="text/javascript"></script>
@endpush
