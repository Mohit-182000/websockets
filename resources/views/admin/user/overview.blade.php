@extends('admin.layout.app')
@section('title','Profile Overview')
@section('content')
<div class="container-fluid">
        <div class="row">

          <div class="col-md-4">
             <div class="card card-primary card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center" id="tag_container">
                          <img class="profile-user-img img-fluid img-circle" id="showcropimg"
                               src="{{ $admin->profile_image }}"
                               alt="User profile picture">
                          </div>

                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item" style="border:none;">
                                <b>Name</b> <a class="ml-2"> {{ $admin->name ?? '' }}</a>
                              </li>
                              <li class="list-group-item">
                                <b>Email</b> <a class="ml-2"> {{ $admin->email ?? '' }}</a>
                              </li>

                            </ul>


                      </div>
                      <!-- /.card-body -->
             </div>
        </div>
          
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active text-white">Profile</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">

                  <div class="tab-content">
                    <div class="card-body box-profile">

                      <div class="row">
                        <div class="col-md-6 mb-4">
                            <b>Name :</b> <a class="ml-2"> {{ $admin->name ?? '' }} </a>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Email :</b> <a class="ml-2"> {{ $admin->email ?? '' }}</a>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>User Type :</b> <a class="ml-2"> {{ $admin->user_type ?? '' }}</a>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Is Active :</b> <a class="ml-2"> {{ $admin->is_active ?? '' }}</a>
                        </div>
                      </div>

              </div>

                  </div>



                  <!-- /.tab-pane -->

                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection
