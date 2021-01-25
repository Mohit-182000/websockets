<?php

namespace App\Http\Controllers\api;

use Auth;
use App\User;
use Exception;
use App\Model\JobPost;
use App\Model\UserJobApply;
use Illuminate\Http\Request;
use App\Model\KnowledgeBank;
use App\Model\Homepagebanner;
use App\Http\Controllers\Controller;
use App\Model\JobSeekerQualification;
use App\Model\JobSeekerWorkExperience;
use App\Http\Controllers\ApiController;
use App\Model\Payment;
use App\Model\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

class JobSeekerApiController extends ApiController
{
	public function profile(Request $request)
	{
		try {
			$user = User::with([
				'state:id,name',
				'city:id,name',
				'locality:id,name',
				// 'career_level:id,name',
				// 'qualification',
				// 'qualification.qualificationDetail',
				'job_type' => function ($query) {
					$query->select('jobtype_id as id', 'name');
				},
				'skill' => function ($query) {
					$query->select('skill_id as id', 'name');
				},
				'known_languages' => function ($query) {
					$query->select('knownlanguage_id as id', 'name');
				},
				'interests' => function ($query) {
					$query->select('interests_id as id', 'name');
				},
				'job_seeker_city' => function ($query) {
					$query->select('city_id as id', 'name');
				},
				'preferred_location' => function ($query) {
					$query->select('preferred_location_id as id', 'name');
				},
				'category' => function ($query) {
					$query->select('category_id as id', 'name');
				}
			])->findorfail($this->currentuser()->id);

			$work_experience = [];
			$qualification = [];

            if($user->qualification->count() > 0){

				foreach($user->qualification as $key){
					$qualification[] = [
						'id' => $key->id,
						'user_id' => $key->user_id,
						'qualification_school_name' => $key->school_name ?? '',
						'qualification_qualification_level' => $key->qualificationDetail->name ?? '',
						'qualification_qualification_level_id' => $key->qualification_id ?? '',
						'qualification_field_of_study' => $key->field_of_study ?? '',
						'qualification_start_date' => (isset($key) && $key->start_date != "") ? date('M Y',strtotime($key->start_date)) : null,
						'qualification_current_study_here' => $key->current_study_here ?? null,
						'qualification_end_date' => (isset($key) && $key->end_date != "") ? date('M Y',strtotime($key->end_date)) : null,
					];
				}
			}

			$teacher_info = [
				'were_teaching' => $user->were_teaching ?? null,
				'subject' => $user->subject ?? null,
				'standard' => $user->standard ?? null,
				'medium' => $user->medium ?? null,
				'timing' => $user->timing ?? null,
				'online_teaching_experience' => $user->online_teaching_experience ?? null
			];

			if($user->work_experience->count() > 0){

				foreach($user->work_experience as $key){
					$work_experience[] = [
						'id' => $key->id,
						'user_id' => $key->user_id,
						'position' => $key->position,
						'where_did_you_work' => $key->where_did_you_work,
						'address' => $key->address,
						'start_date' => ($key->start_date != "") ? date('M Y',strtotime($key->start_date)) : null,
						// 'start_date' => '2020-01-01',
						'current_work_here' => $key->current_work_here,
						'end_date' => ($key->end_date != "") ? date('M Y',strtotime($key->end_date)) : null,
						// 'end_date' => '2020-01-01',
					];
				}
			}
			
			$qualification_start_date = 'N/A';
			$qualification_end_date = 'N/A';

			if($user->qualification->first()){

				if($user->qualification->first()->start_date){
					$qualification_start_date = date('M Y',strtotime($user->qualification->first()->start_date));
				}

				if($user->qualification->first()->end_date){
					$qualification_end_date = date('M Y',strtotime($user->qualification->first()->end_date));
				}
			}

			$toReturn = [
				'basic_detail_name' => $user->name ?? null,
				'basic_detail_email' => $user->email ?? null,
				'basic_detail_mobile' => $user->mobile ?? null,
				'basic_detail_address' => $user->address ?? null,
				'basic_detail_milestone' => $user->milestone ?? null,
				'basic_detail_date_of_birth' => ($user->date_of_birth != "") ? date('d-m-Y',strtotime($user->date_of_birth)) : null,
				'basic_detail_state' => $user->state->name ?? null,
				'basic_detail_state_id' => $user->state->id ?? null,
				'basic_detail_city' => $user->city->name ?? null,
				'basic_detail_city_id' => $user->city->id ?? null,
				'basic_detail_pin_code' => $user->pin_code ?? null,
				'basic_detail_gender' => $user->gender,
				'profile_progress' => $user->profile_progress,
				'basic_detail_marital_status' => $user->maritalStatus->name ?? null,
				'basic_detail_marital_status_id' => $user->maritalStatus->id ?? null,
				// 'qualification_school_name' => $user->qualification->first()->school_name ?? '',
				// 'qualification_qualification_level' => $user->qualification->first()->qualificationDetail->name ?? null,
				// 'qualification_qualification_level_id' => $user->qualification->first()->qualification_id ?? null,
				// 'qualification_field_of_study' => $user->qualification->first()->field_of_study ?? null,
				// 'qualification_start_date' => (isset($user->qualification) && $user->qualification->first()->start_date != "") ? date('M Y',strtotime($user->qualification->first()->start_date)) : null,
				// 'qualification_start_date' => (isset($user->qualification) && $user->qualification->start_date != "") ? date('M Y',strtotime($user->qualification->start_date)) : null,
				// 'qualification_start_date' => $qualification_start_date,
				// 'qualification_current_study_here' => $user->qualification->first()->current_study_here ?? null,
				// 'qualification_end_date' => (isset($user->qualification) && $user->qualification->first()->end_date != "") ? date('M Y',strtotime($user->qualification->first()->end_date)) : null,
				// 'qualification_end_date' => (isset($user->qualification) && $user->qualification->end_date != "") ? date('M Y',strtotime($user->qualification->end_date)) : null,
				'qualification_end_date' => $qualification_end_date,
				'excepted_salary' => $user->expected_salary ?? null,
				'salary_type' => $user->salary_type ?? null,
				'job_type' => $user->job_type ?? [],
				'skill' => $user->skill ?? [],
				'is_profile_complete' => ($user->profile_progress > 60) ? 1 : 0,
				'known_languages' => $user->known_languages ?? [],
				'interests' => $user->interests ?? [],
				'job_category' => $user->category ?? [],
				'job_seeker_city' => $user->job_seeker_city ?? [],
				'preferred_location' => $user->preferred_location ?? [],
				'locality_id' => $user->locality_id ?? null,
				'locality_name' => $user->locality->name ?? null,
				'profile_image' => $user->job_seeker_profile_image ?? null,
                'work_experience' => $work_experience,
				'qualification' => $qualification,
				'jobseeker_job_title' => $user->jobseeker_job_title ?? null,
				'teacher_info' => $teacher_info ?? []
			];

			$this->data = $toReturn;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function profileImageEdit(Request $request)
	{
		try {

			$user = $this->currentuser();
			$input = $request->all();

			if ($request->profile_image) {

				$file_data  = $request->input('profile_image');

				$file_name = 'image_'.time().'.png';
				@list($type, $file_data) = explode(';', $file_data);
					@list(, $file_data) = explode(',', $file_data);
				if($file_data!=""){
					Storage::disk('public')->put('profile_image/'.$file_name,base64_decode($file_data));
				}
			}

			$user = User::findorfail($user->id);

			if(empty($user->profile_image)){
				$user->profile_progress = $user->profile_progress + 10;
			}
			$user->profile_image = $file_name ?? null;

			$user->save();

			$this->data = $this->userCollection($user);

		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function profileSalaryEdit(Request $request){
		try{

			$user = $this->currentuser();

			$validator = Validator::make($request->all(), [
				'expected_salary' => 'required|numeric'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$user = User::findorfail($user->id);

			if(empty($user->expected_salary)){
				$user->profile_progress = $user->profile_progress + 10;
			}

			$user->milestone = '0';
			$user->expected_salary = $request->expected_salary ?? null;
			$user->salary_type = $request->salary_type ?? 'Negotiable';
			$user->save();

			$this->data = $this->userCollection($user);
			// $this->data = $user;

		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function profileBasicDetailEdit(Request $request){
		try{

			$user = $this->currentuser();

			$validator = Validator::make($request->all(), [
				'name' => 'required',
				'email' => 'required|email',
				'mobile' => 'required|digits:10|numeric',
				'address' => 'required',
				'date_of_birth' => 'required|date',
				'state_id' => 'required',
				'city_id' => 'required',
				'pincode' => 'required|numeric',
				'gender' => 'required',
				'marital_status' => 'required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$user = User::findorfail($user->id);

			if(empty($user->email) && empty($user->address) && empty($user->date_of_birth) && empty($user->pin_code) && empty($user->gender)){
				$user->profile_progress = $user->profile_progress + 10;
			}

			$user->name = $request->name;
			$user->email = $request->email;
			$user->mobile = $request->mobile;
			$user->address = $request->address;
			$user->date_of_birth = $request->date_of_birth;
			$user->state_id = $request->state_id;
			$user->city_id = $request->city_id;
			$user->pin_code = $request->pincode;
			$user->gender = $request->gender;
			$user->marital_status_id = $request->marital_status;
			$user->jobseeker_job_title = $request->jobseeker_job_title;
			$user->save();

			$user->preferred_location()->detach();

			$this->data = $this->userCollection($user);

		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function profileWorkExperienceEdit(Request $request){
		try{

			$user = $this->currentuser();

			if(!$user->work_experience()->where('user_id', $user->id)->exists()){
				$user->profile_progress = $user->profile_progress + 10;
			}

			$user->save();


			JobSeekerWorkExperience::updateOrCreate(
				[
					'id' => $request->id
				],
				[
					'user_id' => $user->id,
					'position' 			=> $request->position,
					'where_did_you_work' => $request->where_did_you_work,
					'address' 			=> $request->address,
					'start_date' 		=> $request->start_date,
					'current_work_here' => $request->current_work_here ?? 'No',
					'end_date' 			=> $request->end_date ?? null
				]
			);

			$this->data = $this->userCollection($user);

		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}


	public function deleteWorkExperience(Request $request){
		try{
			$user = $this->currentuser();

			$delete = JobSeekerWorkExperience::findorfail($request->id);
			$delete->delete();

			$job_seeker = User::findorfail($user->id);

			if(!$job_seeker->work_experience()->where('user_id', $job_seeker->id)->exists()){
				$job_seeker->profile_progress = $job_seeker->profile_progress - 10;
			}

			$job_seeker->save();

			$this->data = $this->userCollection($user);


		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function updateTeacherAttribute(Request $request){
		try{
			$user = $this->currentuser();

			$job_seeker = User::findorfail($user->id);
			$job_seeker->were_teaching = $request->were_teaching;
			$job_seeker->subject = $request->subject;
			$job_seeker->standard = $request->standard;
			$job_seeker->medium = $request->medium;
			$job_seeker->online_teaching_experience = $request->online_teaching_experience;
			$job_seeker->timing = $request->timing;

			$job_seeker->save();

			$this->data = $this->userCollection($user);


		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}


	public function profileQualificationEdit(Request $request){
		try{


			$validator = Validator::make($request->all(), [
				'school_name' => 'required',
				'qualification_level' => 'required',
				'start_year' => 'required',
			],[
				'school_name.required' => 'institute name is required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$user = $this->currentuser();

			if(!$user->qualification()->where('user_id', $user->id)->exists()){
				$user->profile_progress = $user->profile_progress + 10;
			}

			$user->save();

			JobSeekerQualification::updateOrCreate(
				[
					'id' => $request->id
				],
				[
					'user_id' => $user->id,
					'school_name' => $request->school_name,
					'qualification_id' => $request->qualification_level,
					'field_of_study' => $request->field_of_study,
					'start_date' => $request->start_year,
					'current_study_here' => $request->current_study_here ?? 'No',
					'end_date' => $request->end_year ?? null
				]
			);

			$this->data = $this->userCollection($user);

		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function deleteQualification(Request $request){
		try{
			$user = $this->currentuser();

			$delete = JobSeekerQualification::findorfail($request->id);
			$delete->delete();

			$job_seeker = User::findorfail($user->id);

			if(!$job_seeker->qualification()->where('user_id', $job_seeker->id)->exists()){
				$job_seeker->profile_progress = $job_seeker->profile_progress - 10;
			}

			$job_seeker->save();

			$this->data = $this->userCollection($user);


		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function profileJobTypeEdit(Request $request){
		try{

			$user = $this->currentuser();

			$validator = Validator::make($request->all(), [
				'job_type' => 'required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$job_seeker = User::findOrFail($user->id);

			if(!$job_seeker->job_type()->exists()){
				$job_seeker->profile_progress = $job_seeker->profile_progress + 10;
			}

			$job_seeker->save();

			if ($request->job_type != "") {
				$job_seeker->job_type()->sync($request->job_type);
			}

			$this->data = $this->userCollection($user);

		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function profileJobCategoryEdit(Request $request){
		try{

			$user = $this->currentuser();

			$validator = Validator::make($request->all(), [
				'job_category' => 'required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}



			$job_seeker = User::findOrFail($user->id);

			$job_seeker->skill()->detach();
			
			if ($request->job_category != "") {
				$job_seeker->category()->sync($request->job_category);
			}

			// $job_seeker->save();


			$this->data = $this->userCollection($user);

		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function profileSkillEdit(Request $request){
		try{

			$user = $this->currentuser();

			$job_seeker = User::findOrFail($user->id);

			if(!$job_seeker->skill()->exists()){
				$job_seeker->profile_progress = $job_seeker->profile_progress + 10;
			}

			$job_seeker->save();

			if ($request->skill != "") {
				$job_seeker->skill()->sync($request->skill);
			}

			$this->data = $this->userCollection($user);

		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function profileKnownLanguagesEdit(Request $request){
		try{

			$user = $this->currentuser();

			$validator = Validator::make($request->all(), [
				'known_languages' => 'required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$job_seeker = User::findOrFail($user->id);

			if(!$job_seeker->known_languages()->exists()){
				$job_seeker->profile_progress = $job_seeker->profile_progress + 10;
			}

			$job_seeker->save();

			if ($request->known_languages != "") {
				$job_seeker->known_languages()->sync($request->known_languages);
			}

			$this->data = $this->userCollection($user);

		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function profilePreferredLocationEdit(Request $request){
		try{

			$user = $this->currentuser();

			$validator = Validator::make($request->all(), [
				'preferred_location' => 'required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$job_seeker = User::findOrFail($user->id);

			if(!$job_seeker->preferred_location()->exists()){
				$job_seeker->profile_progress = $job_seeker->profile_progress + 10;
			}

			$job_seeker->save();

			if ($request->preferred_location != "") {
				$job_seeker->preferred_location()->sync($request->preferred_location);
			}

			$this->data = $this->userCollection($user);

		}catch(Exception $e){
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function JobSeekerHomePage(Request $request)
	{
		try {

			$user = $this->currentuser();

			$user_category = $user->category->pluck('id')->toArray();
			$user_location = $user->city_id;
			$user_gender = $user->gender;
			$user_skill = $user->skill->pluck('id')->toArray();
			
			$user_state = $user->state_id;
			$location = State::with('city')->where('id',$user_state)->first();
			$location_cities = $location->city->pluck('id')->toArray();
			
			$feactured_jobs_array = Payment::whereNotNull('job_id')->pluck('job_id')->toArray();

			$category_array = JobPost::whereHas('category',function($category_query) use($user_category){
										$category_query->whereIn('category_id',$user_category);
									})

									->when($location_cities,function($location_sub_query) use ($location_cities){
										$location_sub_query->whereIn('city_id',$location_cities);
									})

									->where(function($query) use($user_skill){

										$query->orWhereHas('skill',function($skill_query) use($user_skill){
											$skill_query->orWhereIn('skill_id',$user_skill);
										});

									})
									->where(['is_active'=>'Yes','is_status'=>'Approved']);	    

			$skill_location_array = JobPost::whereHas('skill',function($skill_query) use($user_skill){
										$skill_query->whereIn('skill_id',$user_skill);
									})
									->when($location_cities,function($location_sub_query) use ($location_cities){
										$location_sub_query->whereIn('city_id',$location_cities);
									})
									->where(['is_active'=>'Yes','is_status'=>'Approved']);
									

			$top_list_array = JobPost::whereHas('category',function($category_query) use ($user_category){
										$category_query->whereIn('category_id',$user_category);
									})
									->where(['city_id' => $user_location])

									->when(($user_gender),function($gender_query) use ($user_gender){
										$gender_query->whereRaw("find_in_set('$user_gender',gender)");
									})

									->whereHas('skill',function($skill_query) use($user_skill){
										$skill_query->whereIn('skill_id',$user_skill);
									})
									->latest()
									->take(7)
									->where(['is_active'=>'Yes','is_status'=>'Approved'])
									->union($skill_location_array)
									->union($category_array)
									->with([
										'job_type:id,name',
										'category:id,name',
										'experience:id,name',
										'user:id,name,profile_image',
										'user_shortlist' => function($query) use ($user){
											$query->where('user_id',$user->id);
										}
									])
									->get();

			$feactured_jobs = JobPost::whereHas('category',function($category_query) use ($user_category){
										$category_query->whereIn('category_id',$user_category);
										$category_query->orderBy('created_at','DESC');
									})
									->whereIn('id',$feactured_jobs_array)
									->where(['is_active'=>'Yes','is_status'=>'Approved'])
									->orderBy('created_at','DESC')
									->with([
										'job_type:id,name',
										'category:id,name',
										'experience:id,name',
										'user:id,name,profile_image',
										'user_shortlist' => function($query) use ($user){
											$query->where('user_id',$user->id);
										}
									])
									->get();
			
			$feactured_jobs = $feactured_jobs->merge($top_list_array);

			$latestJobToReturn = [];
			$bannerToReturn = [];


			foreach ($feactured_jobs as $key => $latest_job) {
			
				$applied = '';
				$shortlisted = '';
				$is_feactured = 0;

				if($latest_job->is_featured()->exists()){
					$is_feactured = 1;
				}
				
				$company_logo = '';
				
				if ($latest_job->user->profile_image != NULL && $latest_job->user->profile_image != "") {
					$company_logo =  asset('storage/profile_image/' . $latest_job->user->profile_image);
				}else{
					$company_logo = null;
				}

				$user_job_apply = $latest_job->user_shortlist;

				if ($user_job_apply != '' && $user_job_apply->is_wishlist == 1) {
					$shortlisted = '1';
				}elseif ($user_job_apply !='' && $user_job_apply->is_wishlist == '') {
					$applied = '1';
				}

				$latestJobToReturn[] = [
					'id' => $latest_job->id,
					'job_title' => $latest_job->job_title,
					'location' => $latest_job->location ?? null,
					'experience' => $latest_job->experience->name ?? null,
					'job_type' => $latest_job->job_type->pluck('name')->implode(',') ?? null,
					'category' => $latest_job->category->pluck('name')->implode(',') ?? null,
					'company_name' => $latest_job->user->name,
					'company_logo' => $company_logo,
					'salary' => $latest_job->minimum_salary .'-'. $latest_job->maximum_salary,
					'is_applied' => $applied,
					'is_shortlisted' => $shortlisted,
					'stattus' => $latest_job->is_status,
					'is_feactured' => $is_feactured
				];

			}

			$home_page_banners = Homepagebanner::get();

			foreach ($home_page_banners as $key => $home_page_banner) {
				$bannerToReturn[] = [
					'id' => $home_page_banner->id,
					'file_name' => $home_page_banner->slider_img,
					'file_path' => $home_page_banner->banner_image
				];
			}

			$knowledge_bank	= KnowledgeBank::where('is_active', 'Yes')
											->select('id','title','media_type','file','link','description',DB::raw('DATE_FORMAT(created_at, "%e %M %Y") as date'),DB::raw('TIME_FORMAT(created_at, "%h:%i:%s %p") as time'))
											->latest()
											->take(6)
											->get();

			$toReturn = [
				'banners' => $bannerToReturn,
				'latest_jobs' => $latestJobToReturn,
				'latest_knowledge_bank' => $knowledge_bank
			];

			$this->data = $toReturn;
			// $this->data = $feactured_jobs;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function jobSeekerJob(Request $request)
	{
		try {

			$type = $request->type;
			$user = $this->currentuser();

			$user_jobs = JobPost::WhereHas(
							'user_job_apply', function($q) use ($user,$type){
								$q->where('user_id',$user->id)

								->when($user->user_type == "JOBSEEKER",function($query) use($type){
										$query->when($type == 1,function($queryType) use($type){
											$queryType->where('is_wishlist',$type);
										},function($query) use($type){
											$query->whereNull('is_wishlist');
										});
								},function($query) use($type){
									$query->where('is_shortlisted',$type);
								});
							})
							->with([
									'experience:id,name',
									'job_type:id,name',
									'category:id,name',
									'user:id,name,profile_image',
									'user_shortlist' => function($query) use ($user){
										$query->where('user_id',$user->id);
									}
								])->select('id','job_title','user_id','location','experience_id','minimum_salary','maximum_salary')
							->paginate(10)->toArray();

			$latestJobToReturn = [];
			$bannerToReturn = [];

			foreach ($user_jobs['data'] as $key => $user_job) {

				$applied = '';
				$shortlisted = '';

				$user_job_apply = $user_job['user_shortlist'];

				if ($user_job_apply != '' && $user_job_apply['is_wishlist'] == 1) {
					$shortlisted = '1';
				}elseif ($user_job_apply !='' && $user_job_apply['is_wishlist'] == '') {
					$applied = '1';
				}

				// $company_logo = '';
				if ($user_job['user']['profile_image'] != NULL && $user_job['user']['profile_image'] != "") {
					$company_logo =  asset('storage/profile_image/' . $user_job['user']['profile_image']);
				}else{
					$company_logo = null;
				}

				$user_jobs['data'][$key]['job_title'] = $user_jobs['data'][$key]['job_title'];
				$user_jobs['data'][$key]['company_name'] = $user_jobs['data'][$key]['user']['name'];
				$user_jobs['data'][$key]['company_logo'] = $company_logo;
				$user_jobs['data'][$key]['location'] = $user_jobs['data'][$key]['location'];
				$user_jobs['data'][$key]['salary'] = $user_jobs['data'][$key]['minimum_salary'].'-'.$user_jobs['data'][$key]['maximum_salary'];
				$user_jobs['data'][$key]['experience'] = $user_jobs['data'][$key]['experience']['name'];
				$user_jobs['data'][$key]['job_type'] = collect($user_jobs['data'][$key]['job_type'])->pluck('name')->implode(',');
				$user_jobs['data'][$key]['category'] = collect($user_jobs['data'][$key]['category'])->pluck('name')->implode(',');
				$user_jobs['data'][$key]['is_applied'] = $applied;
				$user_jobs['data'][$key]['is_shortlisted'] = $shortlisted;

				unset($user_jobs['data'][$key]['user'],$user_jobs['data'][$key]['user_id'],$user_jobs['data'][$key]['minimum_salary'],$user_jobs['data'][$key]['maximum_salary'],$user_jobs['data'][$key]['experience_id'],$user_jobs['data'][$key]['user_shortlist']);
			}

			$this->data = $user_jobs;

		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function jobSeekerJobApply(Request $request)
	{

		$user = $this->currentuser();

		try {

			$validator = Validator::make($request->all(), [
				'job_id' => 'required|numeric'
			]);

			if ($validator->fails()) {
				return response()->json(['error' => $validator->errors()]);
			}

			if($request->remove_wishlist == 1){
				UserJobApply::where('job_id',$request->job_id)->delete();
			}else{
				UserJobApply::updateOrCreate(
					[
						'user_id' => $user->id,
						'job_id' => $request->job_id
					],
					[
						'user_id' => $user->id,
						'job_id' => $request->job_id,
						'is_wishlist' => $request->is_wishlist,
						'applied_date' => date('Y-m-d h:m:s')
					]
				);
			}

			$type = $request->is_wishlist;

			$employer_job_user_applies = JobPost::whereHas('user_job_apply',function($query) use ($user,$type){
											$query->where(['user_id' => $user->id,'is_wishlist' => $type]);
										})
										->with(['job_type:id,name','experience:id,name','user'])
										->select('id','job_title','user_id','location','minimum_salary','maximum_salary','experience_id')
										->paginate(10)
										->toArray();

			foreach($employer_job_user_applies['data'] as $key => $value){

				$employer_job_user_applies['data'][$key]['job_title'] = $employer_job_user_applies['data'][$key]['job_title'];
				$employer_job_user_applies['data'][$key]['location'] = $employer_job_user_applies['data'][$key]['location'];
				$employer_job_user_applies['data'][$key]['salary'] = $employer_job_user_applies['data'][$key]['minimum_salary'].'-'.$employer_job_user_applies['data'][$key]['maximum_salary'];
				$employer_job_user_applies['data'][$key]['experience'] = $employer_job_user_applies['data'][$key]['experience']['name'];
				$employer_job_user_applies['data'][$key]['job_type'] = collect($employer_job_user_applies['data'][$key]['job_type'])->pluck('name')->implode(',');
				$employer_job_user_applies['data'][$key]['company_name'] = $employer_job_user_applies['data'][$key]['user']['name'];
				$employer_job_user_applies['data'][$key]['company_logo'] = $employer_job_user_applies['data'][$key]['user']['profile_image'];

				unset($employer_job_user_applies['data'][$key]['minimum_salary'],
					$employer_job_user_applies['data'][$key]['maximum_salary'],
					$employer_job_user_applies['data'][$key]['user'],
					$employer_job_user_applies['data'][$key]['experience_id']);
			}

			$this->data = $employer_job_user_applies;

		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function generateResume(){
		try{
			$user = $this->currentuser();

			$this->data['basic_details'] = User::where('id',$user->id)->first();
			
			$this->data['image'] = public_path("storage/profile_image/").$this->data['basic_details']->profile_image;
			$this->data['email'] = public_path("storage/default/email.png");
			$this->data['mobile'] = public_path("storage/default/mobile.png");
			$this->data['location'] = public_path("storage/default/location.png");
			$this->data['dob'] = public_path("storage/default/dob.png");
			
			$resume = PDF::loadView('admin.job_seeker.resume', $this->data);
			$resume_name = time().'__'.rand(0,500).'__.pdf';

			Storage::put('resume/'.$resume_name, $resume->output());

			$resume_file = User::findOrFail($user->id);
			Storage::delete('resume/' . $resume_file->resume);
			$resume_file->resume = $resume_name;
			$resume_file->save();

            $resume_file_path = asset('storage/resume/' . $resume_file->resume);

			$toReturn = [
				'file_name' => $resume_file->resume,
				'file_path' => $resume_file_path
			];
			$this->data = $toReturn;

		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
}
