@extends('admin.layout.app')

@section('title',__('job_post.index_title'))

@section('page_title',__('job_post.index_title'))

<style>
    .margin_custome{
        padding-top: 30px;
    }
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
                            <label>Job Type </label>           
                            <select class="form-control select2" data-placeholder="Search Job Type" data-url="{{ route('get.job-type') }}" name="job_type" id="jobType"></select>
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
                            <label>Experience </label>           
                            <select class="form-control select2" data-placeholder="Search Experience" data-url="{{ route('get.experience') }}" name="experience" id="experience"></select>
                        </div>   
                        <div class="col-md-3 form-group">
                            <label>Qualification </label>           
                            <select class="form-control select2" data-placeholder="Search Qualification" data-url="{{ route('get.qualification') }}" name="qualification" id="qualification"></select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Job Status </label>           
                            <select class="form-control jobStatusSelect2" data-placeholder="Search Job Status" name="job_status" id="jobStatus"></select>
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
                            <h3>All Job Post</h3>
                            <div id="buttons" class="float-right"></div>
                        </div>
                    </div>

                    <table id="jobPostTable" data-url="{{ route('admin.job-post.list') }}" class="table table-hover w-100 display nowrap ">
                        <tr>
                            <thead class="gray-light">
                                <th width="15">{{ __('common.id') }}</th>
                                <th>Company Name</th> 
                                <th>Job Title</th> 
                                <th>Job Description</th>
                                <th>Job Category</th> 
                                <th>City</th> 
                                <th data-orderable="false">Experience</th>
                                <th data-orderable="false">Qualification</th>
                                <th data-orderable="false" class="text-center">Approve Status</th>
                                <th width="15%" data-orderable="false" class="text-center">{{__('common.status')}}</th>
                                <th width="5%" data-orderable="false" class="text-center">{{__('common.action')}}</th>
                            </thead>
                        </tr>
                        
                    </table>

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
    

    <script src="{{asset('assets/admin/js/datatables/job_post-datatable.js')}}" type="text/javascript"></script>
@endpush
