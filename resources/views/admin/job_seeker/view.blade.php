@extends('admin.layout.app')

@section('title',$single_user->name)

@section('page_title',$single_user->name)
@section('button')

@endsection
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
                  @if($single_user->job_seeker_profile_image != "")
                    <img class="profile-user-img img-fluid img-circle custome_image"  src="{{ $single_user->job_seeker_profile_image }}" alt="User profile picture">
                  @else
                    <img class="profile-user-img img-fluid img-circle"  src="{{asset('storage/demo/user1.png')}}" alt="User profile picture">
                  @endif
                </div><br>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Name</b> <a class="float-right">{{ $single_user->name }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Mobile</b> <a class="float-right">{{ $single_user->mobile }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{ $single_user->email ?? 'N/A' }}</a>
                  </li>
                  <li class="list-group-item  border border-0">
                    <b>Address</b>
                    <a class="float-right">
                      {{ $single_user->address.' ' ?? '' }} <br>
                      {{$single_user->city->name ?? ' '}}{{' - '.$single_user->pin_code.' ' ?? ''}}
                      <br>{{$single_user->state->name ?? ''}}</a>
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
                        {{-- <i class="fas fa-map-marker-alt mr-1"></i>  --}}
                        Skill
                      </strong>
                        <p class="text-muted">
                          {{ (count($single_user->skill) != 0) ? $single_user->skill->pluck('name')->implode(',') : 'N/A'  }}
                        </p>
                      <hr>

                      <strong>Experience</strong>
                        @php
                          function humanTimings ($start_time,$end_time)
                          {
                              $time = $end_time - $start_time;
                              $time = ($time<1)? 1 : $time;
                              $tokens = array (
                                  31536000 => 'year',
                                  2592000 => 'month'
                              );

                              foreach ($tokens as $unit => $text) {
                                  if ($time < $unit) continue;
                                  $numberOfUnits = floor($time / $unit);
                                  return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
                              }

                          }

                        @endphp

                        @if ($single_user->work_experience != "")
                            @foreach($single_user->work_experience as $work_experience)

                            @php
                                $start_time = strtotime($work_experience->start_date);
                                $end_time = (isset($work_experience) && $work_experience->end_date != "") ? strtotime($work_experience->end_date) : time();
                                $date = humanTimings($start_time,$end_time);

                                if($date != null){
                                  $date = $date;
                                }else{
                                  $date = ' 0 Year';
                                }
                            @endphp

                              <p class="text-muted">
                                {{ $work_experience->position.'-'.$date }}
                              </p>
                            @endforeach
                        @else
                              <p class="text-muted"></p>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>

    </div>

    {{-- =============================================================================================== --}}
    <div class="col-lg-9 col-xl-9 col-md-9 col-9">


            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Overview</a></li>
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Applied</a></li>
                </ul>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                      <div class="col-lg-12">
                          <table id="userJobsTable" data-url="{{ route('admin.user-job.list',$single_user->id) }}" class="table table-hover w-100 display nowrap ">
                            <tr>
                                <thead class="gray-light">
                                    <th>{{ __('common.id') }}</th>
                                    <th>Job Title</th>
                                    <th>Company Name</th>
                                    <th>Location</th>
                                    <th data-orderable="false">Applied On</th>
                                    {{-- <th data-orderable="false" class="text-center">{{__('common.action')}}</th> --}}
                                </thead>
                            </tr>
                          </table>
                      </div>
                  </div>

                  <div class="active tab-pane" id="timeline">

                      <div class="alert alert-primary" role="alert">
                        Personal Details
                      </div>

                      <div class="row mt-3">
                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <strong>Date of Birth</strong>
                              </div>

                              <div class="col-md-6">
                                <p>{{  ($single_user->date_of_birth != "") ? date("d-m-Y", strtotime($single_user->date_of_birth)) : 'N/A' }}</p>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <strong>
                                  {{-- <i class="fas fa-language mr-1"></i>  --}}
                                  Known Languages
                                </strong>
                              </div>
                              <div class="col-md-6">
                                <p>{{ (count($single_user->known_languages) != 0) ? $single_user->known_languages->pluck('name')->implode(' - ') : 'N/A' }}</p>
                              </div>
                            </div>
                          </div>

                      </div>

                      <div class="row mt-3">

                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-6">
                              <strong>
                                {{-- <i class="fas fa-circle mr-1"></i>  --}}
                                Gender
                              </strong>
                            </div>

                            <div class="col-md-6">
                              <p>{{ ($single_user->gender == 'M') ? 'Male' : 'Female' }}</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-6">
                              <strong> Locality
                              </strong>
                            </div>

                            <div class="col-md-6">
                              <p>{{ $single_user->locality->name ?? 'N/A' }}</p>
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="row mt-3">

                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-6">
                              <strong>
                                {{-- <i class="fas fa-circle mr-1"></i>  --}}
                                Marital Status
                              </strong>
                            </div>

                            <div class="col-md-6">
                              <p>{{ $single_user->maritalStatus->name ?? 'N/A' }}</p>
                            </div>
                          </div>
                        </div>

                      </div>

                      @if ($single_user->work_experience !== "")
                        @foreach($single_user->work_experience as $work_experience)

                          @php
                              $date = '';
                              $start_time = strtotime($work_experience->start_date);
                              $end_time = strtotime($work_experience->end_date ?? time());
                              $date = humanTiming($start_time,$end_time);
                              $date = $date;
                          @endphp

                          <div class="alert alert-primary mt-4" role="alert">
                            Professional Detail
                          </div>

                          <div class="row mt-3">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6">
                                  <strong>
                                    {{-- <i class="fas fa-suitcase mr-1"></i>  --}}
                                    Position
                                  </strong>
                                </div>
                                <div class="col-md-6">
                                  {{ $work_experience->position ?? 'N/A' }}
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6">
                                  <strong>Working at</strong>
                                </div>
                                <div class="col-md-6">
                                  {{ $work_experience->where_did_you_work ?? 'N/A' }}
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row mt-3">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6">
                                  <strong> Currently working</strong>
                                </div>
                                <div class="col-md-6">
                                  {{ $work_experience->current_work_here ?? 'No' }}
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6">
                                  <strong> From - To</strong>
                                </div>
                                <div class="col-md-6">
                                  {{  ($work_experience->start_date != "") ? date("d-m-Y", strtotime($work_experience->start_date)) : 'N/A' }} -
                                  {{  ($work_experience->end_date != "") ? date("d-m-Y", strtotime($work_experience->end_date)) : 'N/A' }}
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row mt-3">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6">
                                  <strong>Address</strong>
                                </div>
                                <div class="col-md-6">
                                  {{ $work_experience->address ?? 'N/A' }}
                                </div>
                              </div>
                            </div>
                          </div>
                          <hr>

                        @endforeach
                      @endif

                      @if ($single_user->qualification->count() > 0)
                        <div class="alert alert-primary mt-4" role="alert">
                            Qualification
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>School Name</th>
                                    <th>Qualification</th>
                                    <th>Feild Of Study</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($single_user->qualification as $qualification)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $qualification->school_name }}</td>
                                        <td>{{ $qualification->qualificationDetail->name }}</td>
                                        <td>{{ $qualification->field_of_study }}</td>
                                        <td>{{ ($qualification->start_date != "") ? date('M-Y',strtotime($qualification->start_date)) : 'N/A' }} - <br>{{ ($qualification->end_date != "") ? date('M-Y',strtotime($qualification->end_date)) : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                      @endif

                      <div class="alert alert-primary mt-4" role="alert">
                        Other Details
                      </div>

                      <div class="row mt-3">
                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-6">
                              <strong>
                                Category
                              </strong>
                            </div>
                            <div class="col-md-6">
                              {{ (count($single_user->category) != 0) ? $single_user->category->pluck('name')->implode(' - ') : 'N/A' }}
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-6">
                              <strong>
                                 Job Type</strong>
                            </div>
                            <div class="col-md-6">
                              <p>{{ (count($single_user->job_type) != 0) ? $single_user->job_type->pluck('name')->implode(',') : 'N/A'}}</p>
                            </div>
                          </div>
                        </div>
                      </div>

                      @if ( ($single_user->were_teaching != "") || ($single_user->subject != "") )
                        <div class="row mt-3">
                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <strong>
                                  Were Teaching
                                </strong>
                              </div>
                              <div class="col-md-6">
                                <p>
                                  {{ $single_user->were_teaching ?? 'N/A' }}
                                </p>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <strong>
                                  Subject
                                </strong>
                              </div>
                              <div class="col-md-6">
                                <p>
                                  {{ $single_user->subject ?? 'N/A' }}
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif

                      @if ( ($single_user->standard != "") || ($single_user->medium != "") )
                        <div class="row mt-3">
                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <strong>
                                  {{ ($single_user->were_teaching == 'College') ? 'Stream' : 'Standard'}}
                                </strong>
                              </div>
                              <div class="col-md-6">
                                <p>
                                  {{ $single_user->standard ?? 'N/A' }}
                                </p>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <strong>
                                  Medium
                                </strong>
                              </div>
                              <div class="col-md-6">
                                <p>
                                  {{ $single_user->medium ?? 'N/A' }}
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif

                      @if ( ($single_user->timing != "") || ($single_user->online_teaching_experience != "") )
                        <div class="row mt-3">
                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <strong>
                                  Timing
                                </strong>
                              </div>
                              <div class="col-md-6">
                                <p>
                                  {{ $single_user->timing ?? 'N/A' }}
                                </p>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <strong>
                                  Online Teaching Experience
                                </strong>
                              </div>
                              <div class="col-md-6">
                                <p>
                                  {{ $single_user->online_teaching_experience ?? 'N/A' }}
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif

                      <div class="row mt-3">

                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-6">
                              <strong>
                                {{-- <i class="fas fa-money-bill-alt mr-1"></i>  --}}
                                Preferred Location
                              </strong>
                            </div>
                            <div class="col-md-6">
                              <p>{{ (count($single_user->preferred_location) != 0) ? $single_user->preferred_location->pluck('name')->implode(', ') : 'N/A'}}</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-6">
                              <strong>
                                {{-- <i class="fas fa-money-bill-alt mr-1"></i>  --}}
                                Excepted Salary
                              </strong>
                            </div>
                            <div class="col-md-6">
                              <p>{{ $single_user->expected_salary ?? ''}} ({{ $single_user->salary_type }})</p>
                            </div>
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

@endsection


@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript">
</script>

<script src="{{asset('assets/admin/js/datatables/user-job-post-datatable.js')}}" type="text/javascript"></script>
@endpush

