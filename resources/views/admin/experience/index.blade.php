@extends('admin.layout.app')

@section('title',__('experience.index_title'))

@section('page_title',__('experience.index_title'))
@section('button')
@component('component.heading',
     [
         'add_modal' => collect([
                 'action' => route('admin.experience.create'),
                 'target' => '#addexperience',
                 'btn_name' => __('experience.create_btn'),
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
                            <h3>{{__('experience.table_title')}}</h3>
                        </div>
                    </div>

                    <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

                                <table id="experienceTable" data-url="{{ route('admin.experience.list') }}" class="table table-hover w-100 display nowrap ">
                                     <tr>
                                        <thead class="gray-light">
                                            <th width="15">{{__('common.id')}}</th>
                                            <th>{{__('experience.table.name')}}</th>
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


<script src="{{asset('assets/admin/js/datatables/experience-datatable.js')}}" type="text/javascript"></script>
@endpush
