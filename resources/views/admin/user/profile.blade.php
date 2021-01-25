@extends('admin.layout.app')
@section('title','Profile')
@section('content')
    <div class="container-fluid">
        <div class="row">


            <!-- Profile Image -->
        @include('admin.profile.card-profile')
        <!-- /.card -->

            <!-- About Me Box -->

            <!-- /.card -->

            <!-- /.col -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link "
                                                    href="{{ route('admin.overview.index')}}">Overview</a></li>
                            <li class="nav-item"><a class="nav-link active" href="{{ route('admin.profile.index')}}">Profile</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.change-password.index')}}">Change
                                    Password</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        @if(count($errors) > 0)
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="ik ik-x"></i>
                                        </button>

                                        @foreach ($errors->all() as $error)
                                            <p class="mb-1">{{ $error }}</p>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="tab-content">

                            <!-- /.tab-pane -->

                            <form class="form-horizontal" action="{{ route('admin.profile.change') }}" method="POST"
                                  name="profileForm" id="profileForm">
                                @csrf
                                <input type="hidden" name="admin_id" value="{{ $admin->id }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Name <i class="text-danger">*</i></label>
                                            <div class="message_error">
                                                <input type="text" class="form-control" name="name"
                                                       id="fname"
                                                       value="{{$admin->name  }}">
                                            </div>

                                        </div>
                                    </div>
                                 {{--   <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Last Name <i class="text-danger">*</i></label>
                                            <div class="message_error">
                                                <input type="text" class="form-control" name="last_name" id="last_name"
                                                       value="{{$admin->last_name  }}">
                                            </div>

                                        </div>
                                    </div>--}}
                                </div>


                                <div class="form-group">
                                    <label for="email">Email <i class="text-danger">*</i></label>
                                    <div class="message_error">
                                        <input type="text" class="form-control" name="email" id="email"
                                               value="{{ $admin->email }}">
                                    </div>

                                </div>

                            {{--     <div class="form-group">
                                    <label for="email">Mobile <i class="text-danger">*</i></label>
                                    <div class="message_error">
                                        <input type="text" class="form-control"
                                               name="mobile"
                                               data-rule-number="true"
                                               data-rule-maxlength="10"
                                               data-rule-minlength="10"
                                               id="mobile"
                                               value="{{ $admin->mobile }}">
                                    </div>

                                </div>--}}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" name="save"
                                            id="m_update_profile_submit"><span id="sid" role="status"
                                                                               aria-hidden="true"></span> Update

                                    </button>


                                </div>
                            </form>


                            <!-- /.tab-pane -->


                            <!-- /.tab-pane -->
                        </div>
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
@push('js')
    <script src="{{asset('assets/admin/js/profile.js')}}" type="text/javascript"></script>

@endpush
