@extends('admin.layout.app')

@section('title',__('exam_updates.index_title'))

@section('page_title',__('exam_updates.index_title'))
@section('button')

    <a class="btn btn-primary btn-sm float-right mr-2" href="{{ route('admin.exam-updates.create') }}"><i class="fa fa-plus"></i> {{ __('exam_updates.create_btn') }}</a>

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
                            <h3>{{__('exam_updates.table_title')}}</h3>
                        </div>
                    </div>
                     <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer w-100">

                                <table id="exam_updatesTable" data-url="{{ route('admin.exam-updates.list') }}" class="table table-hover w-100 display nowrap ">
                                     <tr>
                                        <thead class="gray-light">
                                            <th width="25">{{ __('common.id') }}</th>
                                            <th width="40%">{{ __('exam_updates.table.title') }}</th> 
                                            <th class="w-45">{{ __('exam_updates.table.no_of_post') }}</th> 
                                            <th>{{ __('exam_updates.table.lastdate') }}</th>
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

<script src="{{asset('assets/admin/js/datatables/exam_updates-datatable.js')}}" type="text/javascript"></script>

@endpush
