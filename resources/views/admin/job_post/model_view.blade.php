<div class="modal fade" id="viewJob" role="dialog" aria-labelledby="viewJob" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">
                    <h5 class="modal-title">{{ $single_job_post->job_title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body">                
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Job Description</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Job Title</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">{{ $single_job_post->job_title }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Job Preference</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">{{ $single_job_post->category->pluck('name')->implode(',') ?? 'N/A'}}</p>
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
                                        <p class="text-muted">{{ $single_job_post->job_description ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Job Location</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">{{ $single_job_post->location ?? 'N/A' }} </p>
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
                                        <p class="text-muted">{{ $single_job_post->job_type->pluck('name')->implode(',') ?? 'N/A'}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Qualification</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">{{ $single_job_post->qualification->pluck('name')->implode(',') ?? 'N/A'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Experience</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">{{ $single_job_post->experience->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Other Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Gender</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">
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
                                        <strong>Vacancy</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">{{ $single_job_post->vacancy ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Salary</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">{{ $single_job_post->minimum_salary ?? 'N/a' }} {{ $single_job_post->maximum_salary ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Skils</strong>
                                    </div>
                                    <div class="col-md-6">
                                    <p class="text-muted">{{ $single_job_post->skill->pluck('name')->implode(',') ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Career Level</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">{{ $single_job_post->career_level->pluck('name')->implode(',') ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Shifts</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">{{ $single_job_post->shift->pluck('name')->implode(',') ?? 'N/A' }}</p>
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
                                        <p class="text-muted">{{ $single_job_post->marital_status->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Age Restriction</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted">{{ ($single_job_post->is_age_limit == 0) ? 'No' : $single_job_post->age_limit }}</p>
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
                                        <p class="text-muted">{{ $single_job_post->known_languages->pluck('name')->implode(',') ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">                
                <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger">Close</button>
            </div>
        </div>
    </div>
</div>
