@extends('admin.layout.app')

@section('title',__('job_post.index_title'))

@section('page_title',__('job_seeker_management.applicant_list'))
@section('button')

@endsection



@section('content')

<div class="row">
    <div class="col-lg-3 col-xl-3 col-md-3 col-3">
         <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"  src="{{ asset('storage/demo/user1.png') }}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Nirav</h3>

                <p class="text-muted text-center">Software Engineer</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Mobile No</b> <a class="float-right">987654321</a>
                  </li>
                  <li class="list-group-item">
                    <b>Applied Count</b> <a class="float-right">12</a>
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
                <strong><i class="fas fa-book mr-1"></i> Qualification</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

              </div>
              <!-- /.card-body -->
            </div>

    </div>




    {{-- saaaaadddsasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasa --}}
    <div class="col-lg-9 col-xl-9 col-md-9 col-9">
                 
          
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                </ul>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                   


                      <!-- /.col-md-6 -->
                    <div class="col-lg-12">
                   

                                <table id="job_seeker_management_viewTable" data-url="" class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th width="25">{{ __('job_seeker_management.view.no') }}</th>
                                            <th>{{ __('job_seeker_management.view.date') }}</th> 
                                            <th>{{ __('job_seeker_management.view.title') }}</th> 
                                            <th>{{ __('job_seeker_management.view.company') }}</th> 

                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <tr>
                                            <td>1</td>
                                            <td>22-10-2020</td>
                                            <td>Designer</td>
                                            <td>Web Infoway</td>
                                        
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>29-7-2020</td>
                                            <td>Project Manager</td>
                                            <td>MNS</td>
                                        </tr>
                                    </tbody>
                                </table>

                            
                        
                    </div>
                    <!-- /.col-md-6 -->
                    <!-- /.post -->



                  </div>


                  <div class="tab-pane" id="timeline">
                      sdfgsdfsdff
                  </div>
                </div>
                  <!-- /.tab-pane -->
                 
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.card-body -->
            </div>
    
          
    </div>

    {{-- saaaaadddsasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasa --}}


</div>

@endsection


@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript">
</script>

<script src="{{asset('assets/admin/js/datatables/job_seeker_management-datatable.js')}}" type="text/javascript"></script>
@endpush

