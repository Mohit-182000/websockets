@extends('admin.layout.app')

@section('title',$single_job_post->job_title)

@section('page_title',$single_job_post->job_title)

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
                  @if($single_job_post->user->profile_image != "")
                    <img class="profile-user-img img-fluid img-circle custome_image"  src="{{ asset('storage/profile_image/'.$single_job_post->user->profile_image) }}" alt="User profile picture">
                    @else
                    <img class="profile-user-img img-fluid img-circle"  src="{{asset('storage/demo/user1.png')}}" alt="User profile picture">
                  @endif
                </div>

                <h3 class="profile-username text-center">
                    {{ $single_job_post->user->company_name }}
                </h3>

                <p class="text-muted text-center">{{ $single_job_post->user->role }}</p>

                <p class="text-muted text-center"></p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Company <br> Name</b>
                        <a class="float-right">{{ $single_job_post->user->name }}</a>
                    </li>
                  <li class="list-group-item">
                        <b>Email</b>
                        <a href="mailto:{{ $single_job_post->user->email }}" class="float-right">{{ $single_job_post->user->email }}</a>
                    </li>
                  <li class="list-group-item  border border-0">
                    <b>Mobile No</b> <a href="tel:{{ $single_job_post->user->mobile }}" class="float-right">{{ $single_job_post->user->mobile }}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>



                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Company Information </h3>
                  </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong>
                            {{-- <i class="fas fa-map-marker-alt mr-1"></i>  --}}
                          Company Location</strong>

                        <p class="text-muted">
                            {{ $single_job_post->city->name ?? 'N/A' }},{{ $single_job_post->state->name ?? 'N/A' }}
                        </p>


                      <hr>

                      <strong>
                        {{-- <i class="fas fa-globe mr-1"></i>  --}}
                      Website URl</strong>

                    <p class="text-muted">
                        <a href="{{ $single_job_post->user->website_url ?? ''}}" target="_blank">{{ $single_job_post->user->website_url ?? 'N/A' }}</a>
                    </p>

                      <hr>

                      <strong>
                          {{-- <i class="fas fa-info mr-1"></i>  --}}
                          About Company</strong>

                      <p class="text-muted">
                        {{ $single_job_post->user->about_company ?? 'N/A' }}
                      </p>

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
                  <li class="nav-item"><a class="nav-link" href="#applied" data-toggle="tab">Applied</a></li>
                </ul>
            </div><!-- /.card-header -->

            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">

                        <div class="alert alert-primary mt-4" role="alert">
                            Job Description
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Job Title</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ $single_job_post->job_title }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Category</strong>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ (count($single_job_post->category) != 0) ? $single_job_post->category->pluck('name')->implode(',') : 'N/A'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Job Description</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ $single_job_post->job_description ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Job Location</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $single_job_post->location ?? 'N/A'}}</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Job Type</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ (count($single_job_post->job_type) != 0) ? $single_job_post->job_type->pluck('name')->implode(',') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Qualification</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ (count($single_job_post->qualification) != 0) ? $single_job_post->qualification->pluck('name')->implode(' - ') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                <strong>
                                    {{-- <i class="far fa-circle mr-1"></i>  --}}
                                    Experience</strong>
                            </div>

                            <div class="col-md-9">
                                <p>{{ $single_job_post->experience->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="alert alert-primary mt-4" role="alert">
                            Other Information
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong> Gender</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>
                                            @if($single_job_post->gender == 'M')
                                                Male
                                            @elseif($single_job_post->gender == 'F')
                                                Female
                                            @elseif($single_job_post->gender == 'M,F' || $single_job_post->gender == 'F,M')
                                                Male - Female
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>
                                            {{-- <i class="far fa-circle mr-1"></i>  --}}
                                            Vacancy</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ $single_job_post->vacancy }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>
                                            {{-- <i class="fas fa-money-bill-alt mr-1"></i>  --}}
                                            Salary</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ $single_job_post->minimum_salary }} - {{ $single_job_post->maximum_salary }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Skill</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ (count($single_job_post->skill) != 0) ? $single_job_post->skill->pluck('name')->implode(' - ') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row mt-3">

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Known Languages</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ (count($single_job_post->known_languages) != 0) ? $single_job_post->known_languages->pluck('name')->implode(' - ') : 'N/A'}}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Career Level</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ (count($single_job_post->career_level) > 0) ? $single_job_post->career_level->pluck('name')->implode(',') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Shift</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ (count($single_job_post->shift) > 0) ? $single_job_post->shift->pluck('name')->implode(',') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row mt-3">

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Marital Status</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ ($single_job_post->marital_status->count() != 0) ? $single_job_post->marital_status->pluck('name')->implode(',') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Age Restriction</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <p>{{ ($single_job_post->is_age_limit == 0) ? 'No' : 'Yes' }}</p>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>


                    <div class="tab-pane" id="applied">
                        <div class="table">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                <table id="jobPostUserTable" data-url="{{ route('admin.job-post-user.list', $single_job_post->id) }}" class="table table-hover w-100 display nowrap ">
                                     <tr>
                                        <thead class="gray-light">
                                            <th width="15">{{__('common.id')}}</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th data-orderable="false" class="text-center">{{__('common.action')}}</th>
                                        </thead>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    </div>

    {{-- =============================================================================================== --}}


    <div id="load-modal"></div>
</div>

@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript">
</script>

<script src="{{asset('assets/admin/js/datatables/job-post-user-datatable.js')}}" type="text/javascript"></script>
@endpush
