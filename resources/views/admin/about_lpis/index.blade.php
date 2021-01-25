@extends('admin.layout.app')

@section('title',$title)

@section('page_title' ,$title) 

@section('button')
  <a href="{{ route('admin.homepagebanners.create') }}" class="btn btn-primary btn-sm float-right mr-2">
    {{ __('banner.create_btn') }}
  </a>
@endsection
@push('css')
<style type="text/css">
  .dataTables_filter {
display: none;
}
</style>
@endpush

@section('content')
<div class="container-fluid">
  <div class="row"> 
    <!-- /.col-md-6 -->
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <table id="bannerTable" data-url="{{ route('admin.homepagebanners.list') }}" class="table table-hover w-100">
            <thead>
              <tr>
                <th style="width: 10%;"  data-orderable="false">{{ __('banner.table.image') }}</th>
              {{--   <th  width="80%">{{ __('banner.table.title') }}</th>--}}
                 <th style="width: 30%;"  class="" data-orderable="true">{{ __('category.table.created_by') }}</th>
                <th style="width: 30%;"  class="" data-orderable="true">{{ __('category.table.updated_by') }}</th>
                <th  style="width: 30%;" class="text-center" data-orderable="false">{{ __('banner.table.status') }}</th>
                <th class="text-right" data-orderable="false">{{ __('banner.table.action') }}</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      
    </div>
    <!-- /.col-md-6 -->
  </div>
  <!-- /.row -->
</div>
@endsection


@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js')
  <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
  <script src="{{asset('assets/admin/js/datatables/banner.js')}}" type="text/javascript"></script>
@endpush
