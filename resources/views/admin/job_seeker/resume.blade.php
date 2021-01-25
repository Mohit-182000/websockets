<!DOCTYPE html>
<html>
<head>
	<title>{{ $basic_details->name ?? "N/A" }} | Resume</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>
	<div class="container-fluid">
		@if($basic_details->profile_image != "")
			<img src="{{ $image }}" style="border-radius: 50%;" height="150px" width="150px">
		@else
			<img src="/storage/demo/user1.png" alt="">
		@endif
		<h1>{{ $basic_details->name ?? "N/A" }} </h1>
		<span>{{ $basic_details->address ?? "N/A" }}</span>

		<div class="container-fluid mt-4 bg-info text-white rounded">
			<div class="clearfix">
				<div class="float-left mb-2 mt-2 mr-3" style="60px;">
					<img src="{{ $email }}" style="margin-top: 5px;">
					{{ $basic_details->email ?? "N/A" }}
				</div>
				<div class="float-left mb-2 mt-2 mr-3">
					<img src="{{ $mobile }}" style="margin-top: 5px;">
					{{ $basic_details->mobile ?? "N/A" }}
				</div>
				<div class="float-left mb-2 mt-2 mr-3">
					<img src="{{ $location }}" style="margin-top: 5px;">
					{{ $basic_details->city->name ?? "N/A" }}-{{ $basic_details->pin_code ?? "N/A" }}
				</div>

				<div class="float-left mb-2 mt-2 mr-3">
					<img src="{{ $dob }}" style="margin-top: 5px;">
					{{ ($basic_details->date_of_birth != "") ? date('d-M-Y',strtotime($basic_details->date_of_birth)) : "N/A" }}
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
		<br><br><br>

		<h3 class="mt-4">Skill </h3>
		<div class="container-fluid">
			@if($basic_details->skill !="" && $basic_details->skill->count() > 0)
				@php
					$skill_collection = $basic_details->skill->pluck('name');	
				@endphp

				@foreach ($skill_collection as $skill)
					<span class="badge badge-info px-3 py-2 mr-4" style="margin-left: -15px; !important">{{$skill}}</span>
				@endforeach
			@else
				<span class="badge badge-info px-3 py-2" style="margin-left: -15px; !important">Skill Not Added You</span>
			@endif
		</div>
		<br><br>

		<h3 class="mt-1">Educational Profile </h3>
		<table class="table  table-striped">
			<tr class="">
				<th>No.</th>
				<th>School Name</th>
				<th>Field of Study</th>
				<th>Qualification</th>
				<th>Duration</th>
			</tr>

			@if($basic_details->qualification !="" && $basic_details->qualification->count() > 0)
				<tr>
					<td>1.</td>
					<td>{{ $basic_details->qualification->first()->school_name ?? 'N/A' }}</td>
					<td>{{ $basic_details->qualification->first()->field_of_study ?? 'N/A' }}</td>
					<td>{{ $basic_details->qualification->first()->qualificationDetail->name ?? 'N/A' }}</td>
					<td>{{ ($basic_details->qualification->first()->start_date != "") ? date('M-Y',strtotime($basic_details->qualification->first()->start_date)) : '' }} - <br />{{ ($basic_details->qualification->first()->end_date != "") ? date('M-Y',strtotime($basic_details->qualification->first()->end_date)) : 'Currently Study Here' }}</td>
				</tr>
			@else
				<tr>
					<td colspan="4">Educational Profile Not Added You</td>
				</tr>
			@endif
		</table>

		<h3 class="mt-3">Work Experience </h3>
		<table class="table table-striped mb-3">
			<tr class="">
				<th>No.</th>
				<th>Position</th>
				<th>Where did you work</th>
				<th>Address</th>
				<th>Duration</th>
			</tr>

			@if($basic_details->work_experience !="" && $basic_details->work_experience->count() > 0)
				@foreach ($basic_details->work_experience as $work_experience)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $work_experience->position ?? 'N/A' }}</td>
						<td>{{ $work_experience->where_did_you_work ?? 'N/A' }}</td>
						<td>{{ $work_experience->address ?? 'N/A' }}</td>
						<td>{{ ($work_experience->start_date != null) ? date('M-Y',strtotime($work_experience->start_date)) : ''}} - <br>{{ ($work_experience->end_date != null) ? date('M-Y',strtotime($work_experience->end_date)) : 'Currently Working Here'}}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4">Work Experience Not Added You</td>
				</tr>
			@endif
		</table>

		

		<h3 class="mt-3">Other Details </h3>
		<span><b>Gender</b> : {{ ($basic_details->gender == 'M') ? 'Male' : 'Female' }}</span><br />
		<span><b>Marital Status</b> : {{ ($basic_details->marital_status_id != "") ? $basic_details->maritalStatus->name : 'N/A' }}</span><br />
		<span><b>Known Languages</b> : {{ ($basic_details->known_languages !="" && $basic_details->known_languages->count() > 0) ? $basic_details->known_languages->pluck('name')->implode(',') : 'N/A' }}</span><br />
		<span><b>Expected Salary</b> : {{ ( $basic_details->expected_salary != "") ? $basic_details->expected_salary : 'N/A' }}</span><br />
		
	</div>
</body>
</html>