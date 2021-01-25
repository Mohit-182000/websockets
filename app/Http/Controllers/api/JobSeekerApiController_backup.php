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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
				'qualification',
				'qualification.qualificationDetail',
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

			if($user->work_experience != ""){

				foreach($user->work_experience as $key){
					$work_experience[] = [
						'id' => $key->id,
						'user_id' => $key->user_id,
						'position' => $key->position,
						'where_did_you_work' => $key->where_did_you_work,
						'address' => $key->address,
						'start_date' => ($key->start_date != "") ? date('M Y',strtotime($key->start_date)) : null,
						'current_work_here' => $key->current_work_here,
						'end_date' => ($key->end_date != "") ? date('M Y',strtotime($key->end_date)) : null,
					];
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
				'basic_detail_marital_status' => $user->maritalStatus->name ?? null,
				'basic_detail_marital_status_id' => $user->maritalStatus->id ?? null,
				'qualification_school_name' => $user->qualification->school_name ?? null,
				'qualification_qualification_level' => $user->qualification->qualificationDetail->name ?? null,
				'qualification_qualification_level_id' => $user->qualification->qualification_id ?? null,
				'qualification_field_of_study' => $user->qualification->field_of_study ?? null,
				'qualification_start_date' => (isset($user->qualification) && $user->qualification->start_date != "") ? date('M Y',strtotime($user->qualification->start_date)) : null,
				'qualification_current_study_here' => $user->qualification->current_study_here ?? null,
				'qualification_end_date' => (isset($user->qualification) && $user->qualification->end_date != "") ? date('M Y',strtotime($user->qualification->end_date)) : null,
				'excepted_salary' => $user->expected_salary ?? null,
				'salary_type' => $user->salary_type ?? null,
				// 'career_level_id' => $user->career_level->id ?? null,
				// 'career_level_name' => $user->career_level->name ?? null,
				// 'functional_area' => $user->functional_area ?? [],
				'job_type' => $user->job_type ?? [],
				'skill' => $user->skill ?? [],
				'known_languages' => $user->known_languages ?? [],
				'interests' => $user->interests ?? [],
				'job_category' => $user->category ?? [],
				'job_seeker_city' => $user->job_seeker_city ?? [],
				'preferred_location' => $user->preferred_location ?? [],
				'locality_id' => $user->locality_id ?? null,
				'locality_name' => $user->locality->name ?? null,
				'profile_image' => $user->job_seeker_profile_image ?? null,
				'work_experience' => $work_experience
			];

			$this->data = $toReturn;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function profileEdit(Request $request)
	{
		try {

			$input = $request->all();

			$validator = Validator::make($request->all(), [
				'name' => 'required',
				'email' => 'required|email',
				'mobile' => 'required|digits:10|numeric',
				'address' => 'required',
				'date_of_birth' => 'required|date',
				'state_id' => 'required',
				'city_id' => 'required',
				// 'career_level_id' => 'required',
				'pincode' => 'required|numeric',
				'gender' => 'required',
				'marital_status' => 'required',
				'school_name' => 'required',
				'qualification_level' => 'required',
				// 'field_of_study' => 'required',
				'start_year' => 'required',
				'expected_salary' => 'required|numeric',
				'job_type' => 'required',
				'known_languages' => 'required',
				'preferred_location' => 'required',
				'job_category' => 'required'
			],[
				'school_name.required' => 'institute name is required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}


			if ($request->profile_image) {

				$file_data  = $request->input('profile_image');
				//generating unique file name;
				$file_name = 'image_'.time().'.png';
				@list($type, $file_data) = explode(';', $file_data);
					@list(, $file_data) = explode(',', $file_data);
				if($file_data!=""){
					Storage::disk('public')->put('profile_image/'.$file_name,base64_decode($file_data));
				}
				// $profile_image = $request->file('profile_image');
				// $profile_image_name = time() . '_' . rand(0, 500) . '_' . $profile_image->getClientOriginalName();
				// $profile_image_name = str_replace(' ', '_', $profile_image_name);
				// $profile_image->storeAs('profile_image/', $profile_image_name, ['disk' => 'public']);
				// createImage($request['profile_image']);
			}

			$user = User::findorfail($this->currentuser()->id);
			$user->name = $input['name'];
			$user->email = $input['email'];
			$user->mobile = $input['mobile'];
			$user->profile_image = $file_name ?? null;
			$user->address = $input['address'];
			$user->milestone = '0';
			$user->state_id = $input['state_id'];
			$user->city_id = $input['city_id']; 
			// $user->career_level_id = $input['career_level_id']; 
			$user->pin_code = $input['pincode'];
			$user->gender = $input['gender'];
			$user->marital_status_id = $input['marital_status'];
			$user->date_of_birth = $input['date_of_birth'];
			$user->expected_salary = $input['expected_salary'] ?? null;
			$user->salary_type = $input['salary_type'] ?? 'Negotiable';
			$user->save();

			if ($request->job_type != "") {
				$user->job_type()->sync($request->job_type);
			}

			if ($request->skill != "") {
				$user->skill()->sync($request->skill);
			}

			if ($request->known_languages != "") {
				$user->known_languages()->sync($request->known_languages);
			}

			if ($request->location != "") {
				$user->job_seeker_city()->sync($request->location);
			}
			
			if ($request->preferred_location != "") {
				$user->preferred_location()->sync($request->preferred_location);
			}

			if ($request->job_category != "") {
				$user->category()->sync($request->job_category);
			}

			$user_id = $this->currentuser();

			$work_experience_id = array_column($request->work_experience,'id');
			JobSeekerWorkExperience::where('user_id',$user_id->id)
										->whereNotIn('id',$work_experience_id)->delete();

			foreach($request->work_experience as $id => $key){
				JobSeekerWorkExperience::updateOrCreate(
					[
						'id' => $key['id']
					],
					[
						'user_id' => $user_id->id,
						'position' 			=> $key['position'],
						'where_did_you_work' => $key['where_did_you_work'],
						'address' 			=> $key['address'],
						'start_date' 		=> $key['start_date'],
						'current_work_here' => $key['current_work_here'] ?? 'No',
						'end_date' 			=> $key['end_date']
					]
				);
			}

			$qualification = JobSeekerQualification::firstOrNew(['user_id' => $user_id->id]);
			$qualification->school_name = $input['school_name'];
			$qualification->qualification_id = $input['qualification_level'];
			$qualification->field_of_study = $input['field_of_study'];
			$qualification->start_date = $input['start_year'];
			$qualification->current_study_here = $input['current_study_here'];
			$qualification->end_date = $input['end_year'];
			$qualification->save();
		} catch (Exception $e) {
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
			$user_gender = $user->gender;

			$latest_jobs = JobPost::when($user_gender != "",function($query) use($user_gender,$user_category){
									$query->whereHas('category', 
										function($query) use ($user_category,$user_gender){
											$query->whereIn('category_id',$user_category);
											// $query->where('gender',$user_gender);	
											$query->whereRaw("find_in_set('$user_gender',gender)");
										});
								},function($category_query) use($user_category){
									$category_query->whereHas('category',
													function($sub_category_query) use($user_category){
														$sub_category_query->whereIn('category_id',$user_category);
													});
								})->with([
									'job_type:id,name',
									'experience:id,name',
									'user:id,name,profile_image',
									'user_shortlist' => function($query) use ($user){
										$query->where('user_id',$user->id);
									}
								])->select('id','job_title','user_id','location','experience_id','minimum_salary','maximum_salary')
								->where(['is_active'=>'Yes','is_status'=>'Approved'])
								->latest()
								->take(8)
								->get();							

			$latestJobToReturn = [];
			$bannerToReturn = [];
			

			foreach ($latest_jobs as $key => $latest_job) {
				$applied = '';
				$shortlisted = '';
				
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
					'company_name' => $latest_job->user->name,
					'company_logo' => $company_logo,
					'salary' => $latest_job->minimum_salary .'-'. $latest_job->maximum_salary,
					'is_applied' => $applied,
					'is_shortlisted' => $shortlisted
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
}
