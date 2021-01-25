@extends('admin.layout.app')

@section('title',$single_employer->name)

@section('page_title',$single_employer->name)

<style>
  .custome_image{
    height: 100px !important;
  }
</style>
@section('content')

<div class="row">
    <div class="col-lg-3 col-xl-3 col-md-3 col-3">
         <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  @if($single_employer->profile_image != "")
                    <img class="profile-user-img img-fluid img-circle custome_image"  src="{{ asset('storage/profile_image/'.$single_employer->profile_image) }}" alt="User profile picture">
                  @else
                    <img class="profile-user-img img-fluid img-circle"  src="{{asset('storage/demo/user1.png')}}" alt="User profile picture">
                  @endif
                </div>

                <p class="text-muted text-center">{{ $single_employer->role }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                      <b>Company Type</b> 
                      <a class="float-right">{{ $single_employer->companyType->company_type ?? 'N/A' }}</a>
                  </li>  
                  <li class="list-group-item">
                        <b>Email</b> 
                        <a href="mailto:{{ $single_employer->email }}" class="float-right">{{ $single_employer->email }}</a>
                    </li>
                  <li class="list-group-item">
                    <b>Mobile No</b> <a href="tel:{{ $single_employer->mobile }}" class="float-right">{{ $single_employer->mobile }}</a>
                  </li>
                  <li class="list-group-item border border-0">
                    <b>Job Post</b> 
                    <a class="float-right">
                        {{ $single_employer->user_job_post->count() }}
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>



                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">About </h3>
                  </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <strong>
                        {{-- <i class="fas fa-globe mr-1"></i>  --}}
                        Website URl</strong>

                      <p class="text-muted">
                          <a href="{{ $single_employer->website_url }}" target="_blank">{{ $single_employer->website_url }}</a>
                      </p>

                      <hr>

                      <strong>
                        {{-- <i class="fas fa-map-marker-alt mr-1"></i> --}}
                         Location</strong>

                      <p class="text-muted">
                          {{ $single_employer->address }}
                      </p>

                      <hr>

                      <strong>About Company</strong>

                      <p class="text-muted">
                        {{ $single_employer->about_company }}
                      </p>

                      <hr>

                      <strong>Workspace Photo</strong>
                      <div class="row">
                        @if(count($single_employer->user_workspace_photo) != 0)
                          @foreach($single_employer->user_workspace_photo as $image)
                          <div class="col-md-3 mr-1">
                            <a href="{{$image->workspace_photo_url}}" data-toggle="lightbox" data-title="Workspace Photo" data-gallery="gallery">
                              <img class="mt-2" src="{{$image->workspace_photo_url}}" height="30px">
                            </a>
                          </div> 
                          @endforeach
                        @else
                          <p class="text-muted pl-2">N/A</p>
                        @endif
                      </div>

                    </div>
                    <!-- /.card-body -->
                </div>

    </div>




    {{-- =============================================================================================== --}}
    <div class="col-lg-9 col-xl-9 col-md-9 col-9">
                 
          
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Job Post</a></li>
                  <li class="nav-item"><a class="nav-link" href="#applied" data-toggle="tab">Applied number of candidate</a></li>
                </ul>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <div class="col-lg-12">
                      <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                          <table id="employerJobPostTable" data-url="{{ route('admin.employer-job-post.list', $single_employer->id) }}" class="table table-hover w-100 display nowrap ">
                                <tr>
                                  <thead class="gray-light">
                                      <th width="15">{{__('common.id')}}</th>
                                      <th>Job Title</th>
                                      <th>Vacancy</th>
                                      <th>Salary</th>
                                      <th data-orderable="false" class="text-center">{{__('common.action')}}</th>
                                  </thead>
                              </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="applied">
                    <div class="col-lg-12">
                      <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                          <table id="userApply" data-url="{{ route('admin.employer-job-user-apply.list',$single_employer->id) }}" class="table table-hover w-100 display nowrap">
                                <tr>
                                  <thead class="gray-light">
                                      <th width="5">{{__('common.id')}}</th>
                                      <th>Name</th>
                                      <th>Qualification</th>
                                      <th>Excepted Salary</th>
                                      <th data-orderable="false" class="text-center">{{__('common.action')}}</th>
                                  </thead>
                              </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                  <!-- /.tab-pane -->
                 
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.card-body -->
            </div>
    
          
    </div>

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

<script src="{{asset('assets/admin/js/datatables/employer-job-post-datatable.js')}}" type="text/javascript"></script>
{{-- <script src="{{asset('assets/admin/js/datatables/employer-job-user-apply-datatable.js')}}" type="text/javascript"></script> --}}
@endpush
