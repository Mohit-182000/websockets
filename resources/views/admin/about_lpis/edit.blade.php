@extends('admin.layout.app')

@section('title',$title)

@section('page_title',$title)

@section('button')

@endsection

@section('content')
  <div class="row">
      <!-- /.col-md-6 -->
      <div class="col-lg-3">
      </div>
      <div class="col-lg-9">
        <form action="{{ route('admin.homepagebanners.update',$banner->id) }}"  method="POST" autocomplete="off" id="bannerForm" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.banner.inputs' ,['banner' => $banner])
        </form>
      </div>
      <!-- /.col-md-6 -->
  </div>
  <!-- /.row -->
@endsection

@push('css')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('js')
  <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.js') }}" type="text/javascript"></script>
  <script src="{{asset('assets/admin/js/banner.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/admin/js/image-preview.js')}}" type="text/javascript"></script>
@endpush