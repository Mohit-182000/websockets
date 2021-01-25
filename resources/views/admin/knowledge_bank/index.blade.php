@extends('admin.layout.app')

@section('title',__('knowledge_bank.index_title'))

@section('page_title',__('knowledge_bank.index_title'))
@section('button')

    <a class="btn btn-primary btn-sm float-right mr-2" href="{{ route('admin.knowledge-bank.create') }}">
        <i class="fa fa-plus"></i> Add Knowledge Bank
    </a>

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
                            <h3>{{__('knowledge_bank.table_title')}}</h3>
                        </div>
                    </div>

                    <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

                                <table id="knowledge_bankTable" data-url="{{ route('admin.knowledge-bank.list') }}" class="table table-hover w-100 display nowrap ">
                                     <tr>
                                        <thead class="gray-light">
                                            <th width="15">{{__('common.id')}}</th>
                                            <th width="40%">{{__('knowledge_bank.table.title')}}</th>
                                            <th>{{__('knowledge_bank.table.description')}}</th>
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


<script src="{{asset('assets/admin/js/datatables/knowledge_bank-datatable.js')}}" type="text/javascript"></script>
@endpush
