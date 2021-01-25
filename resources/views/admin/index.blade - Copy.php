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
                    <span class="info-box-number">{{ $job_seeker }}</span>
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
                                                <td><label>{{ $job_post_data->is_status }}</label></td>
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
                                        <img src="{{ asset('storage/profile_image/'.$job_seeker_data->profile_image) }}" alt="Product Image" class="img-size-50 custome_round">
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
                                            <img src="{{ asset('storage/profile_image/'.$employer_data->profile_image) }}" alt="Product Image" class="img-size-50 custome_round">
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

            <div class="col-md-8 mt-3 mb-3">
                <select class="form-control" name="chart" onchange="location = this.value;">
                    <option value="/admin/data-filter/Today">Today</option>
                    <option value="/admin/data-filter/Last 7 Days">Last 7 Days</option>
                    <option value="/admin/data-filter/Last 14 Days">Last 14 Days</option>
                    <option value="/admin/data-filter/Last 28 Days">Last 28 Days</option>
                </select>
            </div>

            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Job Post</h3>
                        </div>

                        <div class="card-body">
                            <div class="chart">
                                <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                
            </div>
        </div>
        
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/admin/plugins/chart.js/Chart.min.js') }}"></script>
    

    <script>
        $(function () {
          var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
          var dates = '<?php echo $dates; ?>';


          var areaChartData = {
            // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            labels  : dates,
            datasets: [
                {
                    label               : 'Digital Goods',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [28, 48, 40, 19, 86, 27, 90]
                }
            ]
          }
      
          var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
              display: false
            },
            scales: {
              xAxes: [{
                gridLines : {
                  display : false,
                }
              }],
              yAxes: [{
                gridLines : {
                  display : false,
                }
              }]
            }
        }
      
          var areaChart = new Chart(areaChartCanvas, { 
            type: 'line',
            data: areaChartData, 
            options: areaChartOptions
          })
      
        })
      </script>
@endpush