@extends('admin.layout.app')
@section('title','Dashboard')
@section('page_title','Dashboard')

@section('breadcrumbs')
    @include('admin.layout.breadcrumb', ['breadcrumbs' => [
                     'Dashboard' => route('admin.dashboard'),

                    ]])
@endsection

<style>
    .custome_round{
        border-radius: 50%;
    }
</style>

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-search"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('common.job_seeker') }}</span>
                    <span class="info-box-number">
                    {{ $job_seeker }}
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
          
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-4">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('common.employer') }}</span>
                    <span class="info-box-number">{{ $employer }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
         

        
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-4">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clipboard-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('common.job_post') }}</span>
                    <span class="info-box-number">{{ $job_post }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            
            <div class="col-md-8 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">{{ __('common.lt_job_post') }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                     <!-- /.col-md-6 -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="job_postTable" data-url="" class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th width="25">{{ __('job_post.table.no') }}</th>
                                            <th>{{ __('job_post.table.date') }}</th>
                                            <th>{{ __('job_post.table.title') }}</th>
                                            <th>{{ __('job_post.table.company') }}</th>
                                            <th>{{ __('job_post.table.vacancy') }}</th>
                                            <th width="15%">{{ __('common.status') }}</th>

                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($latest_job_post as $job_post_data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($job_post_data->created_at)) }}</td>
                                                <td>{{ $job_post_data->job_title }}</td>
                                                <td>{{ $job_post_data->user->name }}</td>
                                                <td>{{ $job_post_data->vacancy }}</td>
                                                <td>
                                                    @if($job_post_data->is_status == 'Pending')
                                                        <span class="badge badge-warning">{{ $job_post_data->is_status }}</span>
                                                    @elseif($job_post_data->is_status == 'Expired')
                                                        <span class="badge badge-danger">Job Closed</span>
                                                    @else
                                                        <span class="badge badge-success">{{ $job_post_data->is_status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <a href="{{ route('admin.job_post-index') }}" class="btn btn-sm btn-secondary float-right">{{ __('common.v_job_post') }}</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
        </div>


            <div class="col-md-4 col-sm-6 col-12">
               
                <div class="card">
                    <div class="card-header">
                            <h3 class="card-title">{{ __('common.lt_job_seeker') }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                </button>
                            </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            @foreach($latest_job_seeker as $job_seeker_data)
                                <li>
                                    @if($job_seeker_data->profile_image != null)
                                        <img src="{{ asset('storage/profile_image/'.$job_seeker_data->profile_image) }}" alt="Product Image" style="height: 65px !important; width: 65px !important;" class="img-size-50 custome_round">
                                    @else
                                        <img class="profile-user-img img-fluid img-circle custome_round"  src="{{asset('storage/demo/user1.png')}}" alt="User profile picture">
                                    @endif
                                    <a href="{{ route('admin.job_seeker-view',$job_seeker_data->id) }}" style="color:#000; cursor:pointer;"  class="users-list-name">{{ $job_seeker_data->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="{{ route('admin.job_seeker-index') }}">{{ __('common.v_job_seeker') }}</a>
                    </div>
                    <!-- /.card-footer -->
                </div>


                <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('common.lt_employer') }}</h3>

                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($latest_employer as $employer_data)
                                <li class="item">
                                    <div class="product-img">
                                        @if($employer_data->profile_image != null)
                                            <img src="{{ asset('storage/profile_image/'.$employer_data->profile_image) }}" alt="Product Image" style="height: 50px !important; width: 50px !important;" class="img-size-50 custome_round">
                                        @else
                                            <img class="profile-user-img img-fluid img-circle custome_round"  src="{{asset('storage/demo/user1.png')}}" alt="User profile picture">
                                        @endif
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('admin.employer-view',$employer_data->id) }}" style="color:#000; cursor:pointer;"  class="users-list-name" class="product-title ml-3"><b>{{ $employer_data->name }}</b></a>
                                        <span class="product-description">
                                            {{ $employer_data->role ?? 'N/A' }}
                                        </span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="{{ route('admin.employer-index') }}" class="uppercase">{{ __('common.v_job_seeker') }}</a>
                        </div>
                    <!-- /.card-footer -->
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-2">Job Post</h3>
      
                        <div class="card-tools">
                            <select class="form-control" id="ChartValue"  style="cursor: pointer;">
                                <option value="1">Today</option>
                                <option value="7">Last 7 Days</option>
                                <option value="14">Last 14 Days</option>
                                <option value="28">Last 28 Days</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-2">Job Applied</h3>
      
                        <div class="card-tools">
                            <select class="form-control" id="jobAppliedMenu"  style="cursor: pointer;">
                                <option value="1">Today</option>
                                <option value="7">Last 7 Days</option>
                                <option value="14">Last 14 Days</option>
                                <option value="28">Last 28 Days</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="jobApplied"></canvas>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-2">Profile Creation</h3>
      
                        <div class="card-tools">
                            <select class="form-control" id="profileCreationMenu"  style="cursor: pointer;">
                                <option value="1">Today</option>
                                <option value="7">Last 7 Days</option>
                                <option value="14">Last 14 Days</option>
                                <option value="28">Last 28 Days</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="profileCreation"></canvas>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-2">Shortlisted</h3>
      
                        <div class="card-tools">
                            <select class="form-control" id="shortlistedMenu"  style="cursor: pointer;">
                                <option value="1">Today</option>
                                <option value="7">Last 7 Days</option>
                                <option value="14">Last 14 Days</option>
                                <option value="28">Last 28 Days</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="shortlisted"></canvas>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>
        </div>
        
    </div>
    @endsection
    
@push('scripts')
    <script src="{{ asset('assets/admin/plugins/chart.js/Chart.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" ></script> --}}
    
    <script>
        
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Today'],
                datasets: [{
                    label: '# Job Post',
                    data: [<?php echo $today_job_post; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            min:0,
                            max:<?php echo $total_job_post; ?>,
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true
                // hover: {mode: null}
            }
        });

        $('#ChartValue').on('change',function(){
            var ChartValue = $(this).val();

            $.ajax({
                url: '/admin/dashboard?chart_value='+ChartValue,
                method: 'GET',
                dataType: 'json',
                success: function (res) {
                    // console.log(res.dates);
                    var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: res.dates,
                        datasets: [{
                            label: '# Job Post',
                            data: res.data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min:0,
                                    max:<?php echo $total_job_post; ?>,
                                    beginAtZero: true
                                }
                            }]
                        }
                    },
                    responsive: true
                    });
                }
            });

        });




        var jobAppliedCtx = document.getElementById('jobApplied').getContext('2d');
        var jobApplied = new Chart(jobAppliedCtx, {
            type: 'line',
            data: {
                labels: ['Today'],
                datasets: [{
                    label: '# Job Applied',
                    data: [<?php echo $today_user_apply; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            min:0,
                            max:<?php echo $total_user_apply; ?>,
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true
                // hover: {mode: null}
            }
        });

        $('#jobAppliedMenu').on('change',function(){
            var jobAppliedMenuValue = $(this).val();

            $.ajax({
                url: '/admin/job-applied-chart?job_applied_chart_value='+jobAppliedMenuValue,
                method: 'GET',
                dataType: 'json',
                success: function (res) {
                    
                    var jobAppliedCtx = document.getElementById('jobApplied').getContext('2d');
                    var jobApplied = new Chart(jobAppliedCtx, {
                        type: 'line',
                        data: {
                            labels: res.dates,
                            datasets: [{
                                label: '# Job Applied',
                                data: res.data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        min:0,
                                        max:<?php echo $total_user_apply; ?>,
                                        beginAtZero: true
                                    }
                                }]
                            },
                            responsive: true
                            // hover: {mode: null}
                        }
                    });
                }
            });

        });




        var profileCreationCtx = document.getElementById('profileCreation').getContext('2d');
        var profileCreation = new Chart(profileCreationCtx, {
            type: 'line',
            data: {
                labels: ['Today'],
                datasets: [{
                    label: '# Profile Creation',
                    data: [<?php echo $today_profile_creation; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            min:0,
                            max:<?php echo $total_profile_creation; ?>,
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true
                // hover: {mode: null}
            }
        });

        $('#profileCreationMenu').on('change',function(){
            var profileCreationMenuValue = $(this).val();

            $.ajax({
                url: '/admin/profile-creation-chart?profile_creation_chart_value='+profileCreationMenuValue,
                method: 'GET',
                dataType: 'json',
                success: function (res) {
                    
                    var profileCreationMenuValueCtx = document.getElementById('profileCreation').getContext('2d');
                    var profileCreationMenuValue = new Chart(profileCreationMenuValueCtx, {
                        type: 'line',
                        data: {
                            labels: res.dates,
                            datasets: [{
                                label: '# Profile Creation',
                                data: res.data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        min:0,
                                        max:<?php echo $total_profile_creation; ?>,
                                        beginAtZero: true
                                    }
                                }]
                            },
                            responsive: true
                            // hover: {mode: null}
                        }
                    });
                }
            });

        });



        var shortlistedCtx = document.getElementById('shortlisted').getContext('2d');
        var shortlisted = new Chart(shortlistedCtx, {
            type: 'bar',
            data: {
                labels: ['Today'],
                datasets: [{
                    label: '# Shortlisted',
                    data: [<?php echo $today_shortlist; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            min:0,
                            max:<?php echo $total_shortlist; ?>,
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true
                // hover: {mode: null}
            }
        });

        $('#shortlistedMenu').on('change',function(){
            var shortlistedMenuValue = $(this).val();

            $.ajax({
                url: '/admin/shortlist-chart?shortlist_chart_value='+shortlistedMenuValue,
                method: 'GET',
                dataType: 'json',
                success: function (res) {
                    
                    var shortlistedMenuValueCtx = document.getElementById('shortlisted').getContext('2d');
                    var shortlistedMenuValue = new Chart(shortlistedMenuValueCtx, {
                        type: 'bar',
                        data: {
                            labels: res.dates,
                            datasets: [{
                                label: '# Shorlisted',
                                data: res.data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        min:0,
                                        max:<?php echo $total_shortlist; ?>,
                                        beginAtZero: true
                                    }
                                }]
                            },
                            responsive: true
                            // hover: {mode: null}
                        }
                    });
                }
            });

        });

    </script>

@endpush