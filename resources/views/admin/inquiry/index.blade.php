@extends('admin.layout.app')

@section('title',$title)

@section('page_title' ,$title)



@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="inquiryTable" data-url="{{ route('admin.inquiry.datalist') }}"
                        class="table table-hover w-100">
                        <thead>
                            <tr>
                             {{--    <th>{{ __('contactus.table.subject') }}</th>--}}
                                 <th>Child Name</th> 

                                 <th>{{ __('contactus.table.email') }}</th> 

                                  <th>{{ __('contactus.table.phone') }}</th>
                                <th width="15%">{{ __('contactus.table.date') }}</th>
                                 <th width="10%" data-orderable="false">{{ __('contactus.table.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
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

<script src="{{asset('assets/admin/js/datatables/inquiry.js')}}" type="text/javascript"></script>
@endpush
