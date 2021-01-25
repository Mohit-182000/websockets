@extends('admin.layout.app')

@section('title',__('user.index_title'))

@section('page_title',__('user.index_title'))
@section('button')

    <a class="btn btn-primary btn-sm float-right mr-2" href="{{ route('admin.user.create') }}"><i class="fa fa-plus"></i> {{ __('user.create_btn') }}</a>

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
                            <h3>{{__('user.table_title')}}</h3>
                        </div>
                    </div>
                     <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer w-100">

                                <table id="userTable" data-url="{{ route('admin.user.list') }}" class="table table-hover w-100 display nowrap ">
                                     <tr>
                                        <thead class="gray-light">
                                            <th width="25">{{ __('common.id') }}</th>
                                            <th>{{ __('user.table.name') }}</th> 
                                            <th class="w-45">{{ __('user.table.email') }}</th> 
                                            <th>{{ __('user.table.profile') }}</th>
                                            <th width="15%" data-orderable="false" class="text-center">{{__('common.status')}}</th>
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

<script src="{{asset('assets/admin/js/datatables/user-datatable.js')}}" type="text/javascript"></script>

@endpush

