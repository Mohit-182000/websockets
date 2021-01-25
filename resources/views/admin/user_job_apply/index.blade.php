@extends('admin.layout.app')

@section('title','User Job Apply')

@section('page_title','User Job Apply')
@section('button')

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <table id="UserJobApplyTable" data-url="{{ route('admin.user-job-apply.list') }}" class="table table-hover w-100 display nowrap ">
                        <tr>
                            <thead class="gray-light">
                                <th width="25">{{ __('common.id') }}</th>
                                <th>Name</th> 
                                <th class="w-45">Applied Job</th> 
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
@endpush

@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript">
</script>

<script src="{{asset('assets/admin/js/datatables/user_job_apply-datatable.js')}}" type="text/javascript"></script>
@endpush
