@extends('admin.layout.app')

@section('title',$single_job_view->name)

@section('page_title',$single_job_view->name)

@section('button')
<div class="d-flex flex-justify-end">
    <a class="btn btn-primary" href="{{ route('admin.user_job_apply-index') }}"><i class="fa fa-arrow-left"></i> {{ __('common.back') }}</a>
</div>
@endsection



@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>User Name :</b></label>
                            <p>{{ $single_job_view->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label><b>Email :</b></label>
                            <p>{{ $single_job_view->email }}</p>
                        </div>
                        <div class="col-md-12">
                            <label><b>Applied Job's :</b></label>
                            <?php 
                                $job_post_id = $single_job_view->user_job_apply->pluck('job_id','job_id'); 
                                $jobs = App\Model\JobPost::whereIn('id',$job_post_id)->get();
                            ?>

                            <table class="table mt-3">
                                <tr>
                                    <th>No.</th>
                                    <th>Job Title</th>
                                    <th>Job Description</th>
                                    <th>Location</th>
                                    <th>Salary</th>
                                </tr>

                                @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $job->job_title }}</td>
                                    <td>{{ $job->job_description }}</td>
                                    <td>{{ $job->location }}</td>
                                    <td>{{ $job->minimum_salary }} - {{ $job->maximum_salary }}</td>
                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div>
<div id="load-modal"></div>
@endsection
