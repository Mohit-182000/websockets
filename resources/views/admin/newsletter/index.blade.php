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
                    <table id="newsletterTable" data-url="{{ route('admin.newsletter.datalist') }}"
                        class="table table-hover ">
                        <thead>
                            <tr>
                                <th >{{ __('newsletter.table.email') }}</th>
                                <th width="20%">{{ __('newsletter.table.date') }}</th>
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
@endsection


@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript">
</script>

<script src="{{asset('assets/admin/js/datatables/newsletter.js')}}" type="text/javascript"></script>
@endpush
