@extends('admin.layout.app')

@section('title',__('location.index_title'))

@section('page_title',__('location.index_title'))
@section('button')
@component('component.heading',
     [
         'add_modal' => collect([
                 'action' => route('admin.location-create'),
                 'target' => '#addlocation',
                 'btn_name' => __('location.create_btn'),
                         ])
     ])
@endcomponent
@endsection



@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <table id="locationTable" data-url="" class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th width="25">{{ __('common.id') }}</th>
                                <th>{{ __('location.table.name') }}</th> 
                                <th>{{ __('city.table.city') }}</th> 
                                <th>{{ __('state.table.state') }}</th> 
                                <th width="15%">{{ __('common.status') }}</th>
                                <th width="10%" class="text-left" data-orderable="false">{{ __('common.action') }}</th>

                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <tr>
                                <td>1</td>
                                <td>Iscon Temple</td>
                                <td>Rajkot</td>
                                <td>Gujarat</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                                        <label class="custom-control-label" for="status"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <span class="dropdown">
                                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h text-blue " style="font-size: 22px;"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(40px, 30px, 0px);">
                                        <a class="dropdown-item " data-id=""  href="#">
                                        <i class="fa fa-edit pr-2"></i>Edit
                                        </a>
                                        <a class="dropdown-item " data-id=""  href="#">
                                            {{--  delete class = delete-confrim --}}
                                        <i class="fa fa-trash pr-2"></i>Delete
                                        </a>
                                        </div>

                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Chennai Central</td>
                                <td>Chennai</td>
                                <td>Tamil Nadu</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status1" name="status1" >
                                        <label class="custom-control-label" for="status1"></label>
                                    </div>
                                </td>
                                 <td>
                                    <div class="">
                                        <span class="dropdown">
                                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h text-blue " style="font-size: 22px;"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(40px, 30px, 0px);">
                                        <a class="dropdown-item " data-id=""  href="#">
                                        <i class="fa fa-edit pr-2"></i>Edit
                                        </a>
                                        <a class="dropdown-item " data-id=""  href="#">
                                            {{--  delete class = delete-confrim --}}
                                        <i class="fa fa-trash pr-2"></i>Delete
                                        </a>
                                        </div>

                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
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

<script src="{{asset('assets/admin/js/datatables/location-datatable.js')}}" type="text/javascript"></script>
@endpush
