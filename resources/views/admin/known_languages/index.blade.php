@extends('admin.layout.app')

@section('title',__('known_languages.index_title'))

@section('page_title',__('known_languages.index_title'))
@section('button')
@component('component.heading',
     [
         'add_modal' => collect([
                 'action' => route('admin.known-languages.create'),
                 'target' => '#addknown_languages',
                 'btn_name' => __('known_languages.create_btn'),
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
                            <h3>{{__('known_languages.table_title')}}</h3>
                        </div>
                    </div>

                    <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

                                <table id="known_languagesTable" data-url="{{ route('admin.known-languages.list') }}" class="table table-hover w-100 display nowrap ">
                                     <tr>
                                        <thead class="gray-light">
                                            <th width="15">{{__('common.id')}}</th>
                                            <th>{{__('known_languages.table.name')}}</th>
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


<script src="{{asset('assets/admin/js/datatables/known_languages-datatable.js')}}" type="text/javascript"></script>
@endpush
