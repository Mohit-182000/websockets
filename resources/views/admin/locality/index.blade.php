@extends('admin.layout.app')

@section('title','Locality')

@section('page_title','Locality')
@section('button')
@component('component.heading',
     [
         'add_modal' => collect([
                 'action' => route('admin.locality.create'),
                 'target' => '#addlocality',
                 'btn_name' => __('Add Locality'),
                         ])
     ])
@endcomponent
@endsection



@section('content')
 @include('component.error')
<div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                     <div class="heading-layout1 p-2">
                        <div class="item-title">
                            <h3>All Locality</h3>
                        </div>
                    </div>

                    <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

                            <table id="localityTable" data-url="{{ route('admin.locality.list') }}" class="table table-hover w-100 display nowrap ">
                                 <tr>
                                    <thead class="gray-light">
                                        <th width="15">{{__('common.id')}}</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Locality</th>
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


<script src="{{asset('assets/admin/js/datatables/locality-datatable.js')}}" type="text/javascript"></script>
@endpush
