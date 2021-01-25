@extends('admin.layout.app')

@section('title','Role')

@section('page_title','Role')
@section('button')
@component('component.heading',
     [
         'add_modal' => collect([
                 'action' => route('role.create'),
                 'target' => '#addshifts',
                 'btn_name' => __('Add Role'),
                         ])
     ])
@endcomponent
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
                            <h3>Role</h3>
                        </div>
                    </div>

                    <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

                                <table id="job_postTable" data-url="" class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th width="25">No.</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th width="10%" class="text-left" data-orderable="false">{{ __('common.action') }}</th>

                                        </tr>
                                    </thead>

                                    <tr>
                                        <td>1.</td>
                                        <td>Create</td>
                                        <td>Skill - Create</td>
                                        <td>
                                            <div class="">
                                                <span class="dropdown">
                                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-h text-blue " style="font-size: 22px;"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(40px, 30px, 0px);">
                                                        <a class="dropdown-item">
                                                            <i class="fa fa-edit pr-2"></i>Edit
                                                        </a>
                                                    </div>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td>Edit</td>
                                        <td>Skill - Edit</td>
                                        <td>
                                            <div class="">
                                                <span class="dropdown">
                                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-h text-blue " style="font-size: 22px;"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(40px, 30px, 0px);">
                                                        <a class="dropdown-item">
                                                            <i class="fa fa-edit pr-2"></i>Edit
                                                        </a>
                                                    </div>
                                                </span>
                                            </div>
                                        </td>
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
@endpush

@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript">
</script>

<script src="{{asset('assets/admin/js/datatables/job_post-datatable.js')}}" type="text/javascript"></script>
@endpush