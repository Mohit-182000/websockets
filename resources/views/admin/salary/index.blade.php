@extends('admin.layout.app')

@section('title','Salary')

@section('page_title','Salary')
@section('button')
@component('component.heading',
     [
         'add_modal' => collect([
                 'action' => route('admin.salary.create'),
                 'target' => '#addSalary',
                 'btn_name' => 'Add Salary',
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
                            <h3>All Salary</h3>
                        </div>
                    </div>

                    <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

                            <table id="salaryDatable" data-url="{{ route('admin.salary.list') }}" class="table table-hover w-100 display nowrap ">
                                 <tr>
                                    <thead class="gray-light">
                                        <th width="15">{{__('common.id')}}</th>
                                        <th>Salary</th>
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


<script src="{{asset('assets/admin/js/datatables/salary-datatable.js')}}" type="text/javascript"></script>
@endpush
