<?php

namespace App\Http\Controllers\api;

use DB;
use Auth;
use App\User;
use Exception;
use App\Model\JobPost;
use App\Model\UserJobApply;
use Illuminate\Http\Request;
use App\Model\Homepagebanner;
use App\Model\UserWorksapcePhoto;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Model\JobSeekerWorkExperience;
use App\Model\JobSeekerQualification;
use App\Model\JobType;
use App\Model\MaritalStatus;
use App\Model\Payment;
use App\Model\Setting;
use App\Model\State;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class EmployerProfileApiController extends ApiController
{
	public function employerProfile(Request $request)
	{

		try {
			$user = $this->currentuser();
			$user = User::with(['locality:id,name', 'employerIndustries:id,name','companyType:id,company_type AS name', 'category:id,name', 'state:id,name', 'city:id,name', 'user_workspace_photo:id,user_id,workspace_photo'])
			->select('id', 'name', 'email', 'first_name', 'last_name', 'mobile', 'about_company', 'address', 'website_url', 'is_otp_verify', 'is_active', 'is_complete', 'user_type', 'milestone', 'date_of_birth', 'pin_code', 'gender', 'state_id', 'city_id', 'user_language', 'role', 'profile_image', 'company_type_id','locality_id')
			->findorfail($user->id);


			$employerDetail = [
				'id' => $user->id,
				'name' => $user->name ?? null,
				'email' => $user->email ?? null,
				'first_name' => $user->first_name ?? null,
				'last_name' => $user->last_name ?? null,
				'mobile' => $user->mobile ?? null,
				'about_company' => $user->about_company ?? null,
				'address' => $user->address ?? null,
				'website_url' => $user->website_url ?? null,
				'is_otp_verify' => $user->is_otp_verify,
				'is_active' => $user->is_active,
				'is_complete' => $user->is_complete,
				'user_type' => $user->user_type,
				'milestone' => $user->milestone ?? null,
				'pin_code' => $user->pin_code ?? null,
				'gender' => $user->gender,
				'state_id' => $user->state_id ?? null,
				'state_name' => $user->state->name ?? null,
				'city_id' => $user->city_id ?? null,
				'city_name' => $user->city->name ?? null,
				'user_language' => $user->user_language,
				'role' => $user->role ?? null,
				'industries_id' =>  $user->employerIndustries->pluck('id'),
				'industries_name' => $user->employerIndustries->pluck('name')->implode(','),
				'profile_image' => $user->employer_profile_image ?? null,
				'company_type_id' => $user->company_type_id ?? null,
				'company_type_name' => $user->companyType->name ?? null,
				'token' => $user->createToken('personal MNS Access Token for input store tools')->accessToken,
				'category' => $user->category ?? null,
				'user_workspace_photo' => $user->user_workspace_photo ?? null,
				'locality_id' => $user->locality_id ?? null,
				'locality_name' => $user->locality->name ?? null
			];
			$this->data = $employerDetail;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
	public function getCompanyAutofillDetailOnJobPost(Request $request)
	{

		try {
			$user = $this->currentuser();
			$user = User::with(['locality:id,name', 'state:id,name', 'city:id,name','category:id,name','job_type:id,name'])
				->select('id', 'name', 'mobile', 'address', 'milestone', 'state_id', 'city_id','marital_status_id')
				->findorfail($user->id);

			$job_type = JobType::where('is_active','Yes')->select('id','name')->get();
			$marital_status = MaritalStatus::where('is_active','Yes')->select('id','name')->get();
			$salary_limit = Setting::select('minimum_salary','maximum_salary')->first();

			$employerDetail = [
				'id' => $user->id,
				// 'name' => $user->name ?? null,
				'address' => $user->address ?? null,
				//'milestone' => $user->milestone ?? null,
				'state_id' => $user->state_id ?? null,
				'state_name' => $user->state->name ?? null,
				'city_id' => $user->city_id ?? null,
				'city_name' => $user->city->name ?? null,
				'locality_id' => $user->locality_id ?? null,
				'locality_name' => $user->locality->name ?? null,
				'category' => $user->category ?? [],
				'job_type' => $job_type ?? [],
				'marital_status' => $marital_status ?? [],
				'minimum_salary' => $salary_limit->minimum_salary ?? 0,
				'maximum_salary' => $salary_limit->maximum_salary ?? 0
			];
			$this->data = $employerDetail;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
	public function updateEmployerProfile(Request $request)
	{
		
		try {
			$validator = Validator::make($request->all(), [
				'company_name' => 'required',
				'company_type' => 'required',
				'about_company' => 'required',
				'state_id' => 'required',
				'city_id' => 'required',
				'locality_id' => 'required',
				'mobile' => 'required|digits:10|numeric',
				// 'email' => 'required|email',
				// 'website_url' => 'required',
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$input = $request->all();

			if ($request->hasFile('profile_image')) {
				$profile_image = $request->file('profile_image');
				$profile_image_name = time() . '_' . rand(0, 500) . '_' . $profile_image->getClientOriginalName();
				$profile_image_name = str_replace(' ', '_', $profile_image_name);
				$profile_image->storeAs('profile_image/', $profile_image_name, ['disk' => 'public']);
			}

			// $user = $this->currentuser();
			$user = User::findOrFail($this->currentuser()->id);
			$user->name = $input['company_name'];
			$user->about_company = $input['about_company'];
			$user->profile_image =  $profile_image_name ?? null;
			$user->email = $input['email'] ?? null;
			$user->mobile = $input['mobile'];
			$user->address = $input['address'];
			$user->website_url = $input['website_url'] ?? null;
			$user->milestone = '0';
			$user->locality_id = $input['locality_id'];
			$user->state_id = $input['state_id'];
			$user->city_id = $input['city_id'];
			$user->company_type_id = $input['company_type'];
			$user->role = $input['role'] ?? null;
			$user->is_complete = 1;
			$user->save();

			if($request->industries != ""){
				$user->employerIndustries()->sync($request->industries);
			}

			$this->data = $this->userCollection($user);

		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function updateUserLanguage(Request $request)
	{
		try {

			$input = $request->all();

			$user = $this->currentuser();

			$user = User::findOrFail($user->id);
			$user->user_language = $input['user_language'];
			$user->save();

			$this->data = $this->userCollection($user);
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function updateEmployerPreferences(Request $request){
		try{

			$user = $this->currentuser();

			$validator = Validator::make($request->all(), [
				'industries.*' => 'required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			if ($request->industries != "") {
				$user->interests()->sync($request->industries);
			}
			$this->data = $this->userCollection($user);

		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function updateEmployerCategory(Request $request){
		try{

			$user = $this->currentuser();

			$validator = Validator::make($request->all(), [
				'category.*' => 'required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$user = new User();

			if ($request->category != "") {
				$user->category()->sync($request->category);
			}

		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function categoryUser(Request $request)
	{
		try {
			$user = $this->currentuser();

			$job_seeker = User::findorfail($user->id);

			if(!$job_seeker->category()->exists()){
				$job_seeker->profile_progress = $job_seeker->profile_progress + 10;
			}

			$job_seeker->category()->sync($request->category);
			$job_seeker->save();

			$this->data = $this->userCollection($user);
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
	public function deleteUserWorkspacePhoto(Request $request)
	{
		try {
			$id = $request->workspace_photo_id;
			$delete = UserWorksapcePhoto::findorfail($id);
			$delete->delete();
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccessWithoutDataObject();
	}

	public function employerJobPostList(Request $request)
	{
		$user = $this->currentuser();

		try {

			$type = $request->type;

			$job_post_list = JobPost::when($user->user_type == "EMPLOYER", function ($query) use ($type, $user){
				$query->when($type == 1,function($queryType) use ($user){
					$queryType->where(['is_status'=> 'Approved','user_id'=> $user->id]);
				},function($queryType) use ($user){
					$queryType->where('user_id', $user->id);
				});
			})
			->with(['category','skill','is_featured'])
			->paginate(10)
			->toArray();

			foreach($job_post_list['data'] as $key => $job_post){

				$category = collect($job_post_list['data'][$key]['category'])->pluck('id')->toArray();
				$city = $job_post_list['data'][$key]['city_id'];

				$gender = $job_post_list['data'][$key]['gender'];
				$gender = explode(',',$job_post_list['data'][$key]['gender']);

				$skill = collect($job_post_list['data'][$key]['skill'])->pluck('id')->toArray();

				$payment_date = $job_post_list['data'][$key]['is_featured']['created_at'];


				$matching_candidate = User::whereHas('category',function($category_query) use ($category){
										$category_query->whereIn('category_id',$category);
									})
									->when($city,function($city_query) use ($city){
										$city_query->where('city_id',$city);
									})
									->when($gender,function($gender_query) use ($gender){
										$gender_query->whereIn('gender',$gender);
									})
									->whereHas('skill',function($skill_query) use ($skill){
										$skill_query->whereIn('skill_id',$skill);
									})
									->where('user_type','JOBSEEKER')
									->count();
		

				$job_post_list['data'][$key]['id'] = $job_post_list['data'][$key]['id'];
				$job_post_list['data'][$key]['job_title'] = $job_post_list['data'][$key]['job_title'];
				$job_post_list['data'][$key]['vacancy'] = $job_post_list['data'][$key]['vacancy'];
				$job_post_list['data'][$key]['job_post_date'] = date('d-M-y',strtotime($job_post_list['data'][$key]['created_at']));
				$job_post_list['data'][$key]['is_status'] = ($job_post_list['data'][$key]['is_status'] == 'Expired') ? 'Job Closed' : $job_post_list['data'][$key]['is_status'];
				$job_post_list['data'][$key]['matching_candidate'] = $matching_candidate ?? null;
				$job_post_list['data'][$key]['remaining_days'] = date_difference($payment_date);
				$job_post_list['data'][$key]['is_closed_btn'] = ($job_post_list['data'][$key]['is_status'] == 'Approved') ? 1 : 0;

				unset(
					$job_post_list['data'][$key]['category'],
					$job_post_list['data'][$key]['skill'],
					$job_post_list['data'][$key]['user_id'],
					$job_post_list['data'][$key]['job_description'],
					$job_post_list['data'][$key]['location'],
					$job_post_list['data'][$key]['gender'],
					$job_post_list['data'][$key]['salary'],
					$job_post_list['data'][$key]['experience_id'],
					$job_post_list['data'][$key]['state_id'],
					$job_post_list['data'][$key]['city_id'],
					$job_post_list['data'][$key]['minimum_salary'],
					$job_post_list['data'][$key]['maximum_salary'],
					$job_post_list['data'][$key]['is_age_limit'],
					$job_post_list['data'][$key]['age_limit'],
					$job_post_list['data'][$key]['is_active'],
					$job_post_list['data'][$key]['added_by'],
					$job_post_list['data'][$key]['updated_by'],
					$job_post_list['data'][$key]['created_at'],
					$job_post_list['data'][$key]['updated_at'],
					$job_post_list['data'][$key]['is_featured']
				);
			}

			$this->data = $job_post_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function matchingCandidateList(Request $request){
		try{

			$job_id = $request->id;

			$job_post = JobPost::with(['category','skill'])->findOrFail($job_id);

			$category = $job_post->category->pluck('id')->toArray();
			$city = $job_post->city_id;

			$gender = $job_post->gender;
			$gender = explode(',',$gender);

			$skill = $job_post->skill->pluck('id')->toArray();

			$matching_candidate = User::whereHas('category',function($category_query) use ($category){
									$category_query->whereIn('category_id',$category);
								})
								->when($city,function($city_query) use ($city){
									$city_query->where('city_id',$city);
								})
								->when($gender,function($gender_query) use ($gender){
									$gender_query->whereIn('gender',$gender);
								})
								->whereHas('skill',function($skill_query) use ($skill){
									$skill_query->whereIn('skill_id',$skill);
								})
								// ->select('id','profile_image','name','state_id','city_id','expected_salary','address','salary_type')
								->with(['work_experience','qualification','qualification.qualificationDetail','is_featured'])
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes'])
								->paginate(10)
								->toArray();

		foreach($matching_candidate['data'] as $key => $view_more_candidate){

			$profile_image = null;

			$is_feactured = 0;
			
			if($matching_candidate['data'][$key]['is_featured'] > 0){
				if($matching_candidate['data'][$key]['is_featured']['user_id'] == $matching_candidate['id']){
					$is_feactured = 1;
				}
			}

			if($matching_candidate['data'][$key]['profile_image'] != null){
				$profile_image = asset('storage/profile_image/' . $matching_candidate['data'][$key]['profile_image']);
			}

			if(count($matching_candidate['data'][$key]['qualification']) > 0){
				$qualification = $matching_candidate['data'][$key]['qualification'][0]['qualification_detail']['name'];
			}

			if(count($matching_candidate['data'][$key]['work_experience']) > 0){
				$experience = $matching_candidate['data'][$key]['work_experience'][0]['position'].' '.humanTiming($matching_candidate['data'][$key]['work_experience'][0]['start_date'],$matching_candidate['data'][$key]['work_experience'][0]['end_date']);
			}

			$matching_candidate['data'][$key]['profile_image'] = $profile_image;
			$matching_candidate['data'][$key]['name'] = $matching_candidate['data'][$key]['name'] ?? null;
			$matching_candidate['data'][$key]['expected_salary'] = $matching_candidate['data'][$key]['expected_salary'] ?? null;
			$matching_candidate['data'][$key]['address'] = $matching_candidate['data'][$key]['address'] ?? null;
			$matching_candidate['data'][$key]['salary_type'] = $matching_candidate['data'][$key]['salary_type'] ?? null;
			$matching_candidate['data'][$key]['qualification'] = $qualification ?? null;
			$matching_candidate['data'][$key]['is_feactured'] = $is_feactured;
			$matching_candidate['data'][$key]['user_experience'] = $experience ?? null;
			
			unset(
				$matching_candidate['data'][$key]['employer_profile_image'],
				$matching_candidate['data'][$key]['work_experience'],
				$matching_candidate['data'][$key]['email'],
				$matching_candidate['data'][$key]['first_name'],
				$matching_candidate['data'][$key]['last_name'],
				$matching_candidate['data'][$key]['mobile'],
				$matching_candidate['data'][$key]['resume'],
				$matching_candidate['data'][$key]['thum_path'],
				$matching_candidate['data'][$key]['otp'],
				$matching_candidate['data'][$key]['is_otp_verify'],
				$matching_candidate['data'][$key]['is_active'],
				$matching_candidate['data'][$key]['email_verified_at'],
				$matching_candidate['data'][$key]['user_type'],
				$matching_candidate['data'][$key]['role'],
				$matching_candidate['data'][$key]['user_language'],
				$matching_candidate['data'][$key]['company_name'],
				$matching_candidate['data'][$key]['about_company'],
				$matching_candidate['data'][$key]['website_url'],
				$matching_candidate['data'][$key]['milestone'],
				$matching_candidate['data'][$key]['locality_id'],
				$matching_candidate['data'][$key]['company_type_id'],
				$matching_candidate['data'][$key]['date_of_birth'],
				$matching_candidate['data'][$key]['state_id'],
				$matching_candidate['data'][$key]['pin_code'],
				$matching_candidate['data'][$key]['career_level_id'],
				$matching_candidate['data'][$key]['pin_code'],
				$matching_candidate['data'][$key]['gender'],
				$matching_candidate['data'][$key]['marital_status_id'],
				$matching_candidate['data'][$key]['is_complete'],
				$matching_candidate['data'][$key]['profile_progress'],
				$matching_candidate['data'][$key]['provider'],
				$matching_candidate['data'][$key]['provider_id'],
				$matching_candidate['data'][$key]['created_at'],
				$matching_candidate['data'][$key]['updated_at'],
				$matching_candidate['data'][$key]['admin_profile'],
				$matching_candidate['data'][$key]['is_featured'],
				$matching_candidate['data'][$key]['job_seeker_profile_image'],
				$matching_candidate['data'][$key]['city_id']
			);
		}

			$this->data = $matching_candidate;
			
		} catch (Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function employerJobs(Request $request)
	{
		$user = $this->currentuser();
		
		try {

			// $payment_job_array = Payment::where(['user_id' => $user->id, 'is_active' => 'Yes'])->pluck('job_id')->toArray();

			$job_post_list = JobPost::where(['user_id' => $user->id, 'is_status' => 'Approved', 'is_active' => 'Yes'])
									->with(['is_featured'])
									->get();
									
			$map = $job_post_list->map(function($items){

				$is_payment = 0;

				if($items->is_featured()->exists()){
					$is_payment = 1;
				}

				$toReturn['id'] = $items->id;
				$toReturn['job_title'] = $items->job_title;
				$toReturn['is_payment'] = $is_payment;

				return $toReturn;
			});

			$this->data = $map;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getEmployerJobSeeker(Request $request)
	{
		try {

			$user = $this->currentuser();
			$user_category = User::find($user->id)->category->pluck('id')->toArray();

			$employer_job_seeker = User::WhereHas(
				'category',
				function ($query) use ($user_category) {
					$query->whereIn('category_id', $user_category);
				}
			)
			->whereNotIn('id', [$user->id])
			->where('user_type', 'jobseeker')
			->paginate(10);

			$this->data = $employer_job_seeker;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function employerHomePage(Request $request){
		try {

			$user = $this->currentuser();
			
			$user_category = $user->category->pluck('id')->toArray();
			$job_city_id = $user->user_job_post->where('is_status','Approved')->pluck('city_id')->toArray();
			$job_state_id = $user->user_job_post->where('is_status','Approved')->pluck('state_id')->toArray();

			$job_gender = $user->user_job_post->where('is_status','Approved')->pluck('gender')->implode(',');
			$job_gender = array_unique(explode(',',$job_gender));

			$user_job_post = $user->user_job_post->where('is_status','Approved')->pluck('id')->toArray();
			
			$job_category = JobPost::with('category','skill')
									->whereIn('id',$user_job_post)
									->get();
									
			$job_state = State::with('city')
									->whereIn('id',$job_state_id)
									->get();

			$category = [];
			$skill = [];
			$city = [];

			
			foreach($job_state as $item){

				if($item->city->count() > 0){
					$city_aaray = $item->city->pluck('id')->toArray();
					$city = array_unique(array_merge($city,$city_aaray));
				}
				
			}
			
			foreach($job_category as $item){
				
				$cat_aaray = $item->category->pluck('id')->toArray();
				$category = array_unique(array_merge($category,$cat_aaray));
				
				if($item->skill->count() > 0){
					$skill_aaray = $item->skill->pluck('id')->toArray();
					$skill = array_unique(array_merge($skill,$skill_aaray));
				}
				
			}
			
			$feactured_candicate_array = Payment::whereNull('job_id')->pluck('user_id');
			
			$qualification_array = JobSeekerQualification::pluck('user_id')->toArray();
			$home_page_banners = Homepagebanner::get();

			$bannerToReturn = [];

			foreach ($home_page_banners as $key => $home_page_banner) {
				$bannerToReturn[] = [
					'id' => $home_page_banner->id,
					'file_name' => $home_page_banner->slider_img,
					'file_path' => $home_page_banner->banner_image
				];
			}

			$first_array = User::with('category')->whereHas('category',function($category_query) use ($user_category){
									$category_query->whereIn('category_id',$user_category);
								})
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes']);
			

			$second_array = User::with('category')->whereHas('category',function($category_query) use ($category){
									$category_query->whereIn('category_id',$category);
								})
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes']);

			$third_array = User::whereHas('category',function($category_query) use ($category){
									$category_query->whereIn('category_id',$category);
								})
								->when($city,function($city_query) use ($city){
									$city_query->whereIn('city_id',$city);
								})

								->where(function($query) use ($skill){

									$query->orWhereHas('skill',function($skill_query) use($skill){
										$skill_query->orWhereIn('skill_id',$skill);
									});

								})
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes']);
								
			$fourth_array = User::whereHas('category',function($category_query) use ($category){
									$category_query->whereIn('category_id',$category);
								})
								->when($city,function($city_query) use ($city){
									$city_query->whereIn('city_id',$city);
								})

								->where(function($query) use ($skill){

									$query->orWhereHas('skill',function($skill_query) use($skill){
										$skill_query->whereIn('skill_id',$skill);
									});

								})
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes']);
								
			
			$latest_candidates = User::whereHas('category',function($category_query) use ($category){
									$category_query->whereIn('category_id',$category);
								})
								->when($job_city_id,function($city_query) use ($job_city_id){
									$city_query->whereIn('city_id',$job_city_id);
								})
								->when($job_gender,function($gender_query) use ($job_gender){
									$gender_query->whereIn('gender',$job_gender);
								})
								->whereHas('skill',function($skill_query) use ($skill){
									$skill_query->whereIn('skill_id',$skill);
								})
								->with(['work_experience','qualification','skill'])
								// ->withCount(['skill'])
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes'])
								->latest()
								->take(7)
								->union($fourth_array)
								->union($third_array)
								->union($second_array)
								->union($first_array)	
								->get();

			$feacture_candidate = User::whereHas('category',function($category_query) use ($user_category){
									$category_query->whereIn('category_id',$user_category);
								})
								->orderBy('created_at','DESC')
								->whereIn('id',$feactured_candicate_array)
								->with(['work_experience','qualification'])
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes'])
								->get();
								
			$feacture_candidate = $feacture_candidate->merge($latest_candidates);

			$latest_candidates_array = [];

			foreach ($feacture_candidate as $key => $latest_candidate) {
				$experience = '';
				$qualification = '';

				$is_feactured = 0;

				if($latest_candidate->is_featured()->exists()){
					$is_feactured = 1;
				}
				
				if($latest_candidate->qualification->count() > 0){
					$qualification = $latest_candidate->qualification->first()->qualificationDetail->name;
				}

				if($latest_candidate->work_experience->count() > 0){
					$experience = $latest_candidate->work_experience->first()->position.' '.humanTiming($latest_candidate->work_experience->first()->start_date,$latest_candidate->work_experience->first()->end_date);
				}

				$latest_candidates_array[] = [
					'id' => $latest_candidate->id,
					'profile_image' => $latest_candidate->job_seeker_profile_image ?? '',
					'name' => $latest_candidate->name ?? '',
					'expected_salary ' => $latest_candidate->expected_salary  ?? '',
					'address' => $latest_candidate->address ?? '',
					'salary_type' => $latest_candidate->salary_type ?? '',
					'qualification' =>  $qualification,
					'user_experience' =>  $experience,
					'is_feactured' => $is_feactured
				];
			}

			$toReturn = [
				'banners' => $bannerToReturn,
				'latest_candidate' => $latest_candidates_array
				
			];

			$this->data = $toReturn;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getEmployerJobUserApply(Request $request){
		try {

			$type = $request->type;
			$job_id = $request->job_id;

			$employer_job_user_applies = User::whereHas('user_job_apply',function($query) use ($job_id, $type){
											$query->where(['job_id' => $job_id, 'is_shortlisted' => $type]);
										})
										->with(['user_job_apply' => function($query) use($job_id){
											$query->where('job_id',$job_id);
										},'qualification','user_job_apply.job_post','is_featured'])
										->select('id','name','address','profile_image','expected_salary')
										->paginate(10)
										->toArray();

			foreach($employer_job_user_applies['data'] as $key => $value){

				$is_feactured = 0;	
				
				if($employer_job_user_applies['data'][$key]['is_featured'] > 0){
					if($employer_job_user_applies['data'][$key]['is_featured']['user_id'] == $employer_job_user_applies['data'][$key]['id']){
						$is_feactured = 1;
					}
				}

				if ($employer_job_user_applies['data'][$key]['profile_image'] != NULL && $employer_job_user_applies['data'][$key]['profile_image'] != "") {
					$profile_image =  asset('storage/profile_image/' . $employer_job_user_applies['data'][$key]['profile_image']);
				}else{
					$profile_image = null;
				}

				// dd($employer_job_user_applies['data'][$key]['qualification']['field_of_study']);

				$employer_job_user_applies['data'][$key]['name'] = $employer_job_user_applies['data'][$key]['name'];
				$employer_job_user_applies['data'][$key]['address'] = $employer_job_user_applies['data'][$key]['address'];
				$employer_job_user_applies['data'][$key]['profile_image'] = $profile_image;
				$employer_job_user_applies['data'][$key]['expected_salary'] = $employer_job_user_applies['data'][$key]['expected_salary'];
				$employer_job_user_applies['data'][$key]['qualification'] = $employer_job_user_applies['data'][$key]['qualification']['field_of_study'] ?? '';
				$employer_job_user_applies['data'][$key]['apply_date'] = ($employer_job_user_applies['data'][$key]['user_job_apply'][0]['applied_date'] != "") ? date('d-m-Y',strtotime($employer_job_user_applies['data'][$key]['user_job_apply'][0]['applied_date'])) : '';
				$employer_job_user_applies['data'][$key]['job_title'] = $employer_job_user_applies['data'][$key]['user_job_apply'][0]['job_post']['job_title'] ?? '';
				$employer_job_user_applies['data'][$key]['job_id'] = $employer_job_user_applies['data'][$key]['user_job_apply'][0]['job_post']['id'] ?? '';
				$employer_job_user_applies['data'][$key]['experience'] = '2 Year';
				$employer_job_user_applies['data'][$key]['is_feactured'] = $is_feactured;

				unset($employer_job_user_applies['data'][$key]['user_job_apply'],$employer_job_user_applies['data'][$key]['employer_profile_image'],$employer_job_user_applies['data'][$key]['job_seeker_profile_image'],$employer_job_user_applies['data'][$key]['is_featured']);
			}

			$this->data = $employer_job_user_applies;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function employerShortlistUser(Request $request){
		try{

			if($request->unshortlist_user == 1){
				UserJobApply::where([
							'job_id' => $request->job_id,
							'user_id' => $request->user_id
						])
						->update([
							'is_shortlisted' => 0
						]);
			}else{
				UserJobApply::where([
										'job_id' => $request->job_id,
										'user_id' => $request->user_id
									])
									->update([
										'is_shortlisted' => 1
									]);
			}
		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function employerJobSeekerDetail(Request $request){
		try{

			$job_seeker_detail = User::findOrFail($request->user_id);
			// $job_seeker_qualification = JobSeekerWorkExperience::where('user_id',$job_seeker_detail)->first();
			// dd($job_seeker_qualification);

			$toReturn = [];

			function humanTiming ($start_time,$end_time)
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

			if(!empty($request->job_id)){
				$job_post_detail = JobPost::with([
					'user_shortlist' => function($query) use ($job_seeker_detail){
						$query->where('user_id',$job_seeker_detail->id);
					}
				])->where('id',$request->job_id)->first();

				// $job_post_detail = JobPost::findOrFail($request->job_id);

				$shortlisted = '';

				$user_job_apply = $job_post_detail->user_shortlist;

				if ($user_job_apply != '' && $user_job_apply->is_shortlisted == 1) {
					$shortlisted = '1';
				}

				if($job_post_detail->gender != ""){
					if($job_post_detail->gender == "M"){
						$job_post_gender = "Male";
					}elseif($job_post_detail->gender == "F"){
						$job_post_gender = "Female";
					}elseif($job_post_detail->gender == "M,F" || $job_post_detail->gender == "F,M"){
						$job_post_gender = "Male - Female";
					}
				}

				$job_detail = [
					'id' => $job_post_detail->id,
					'job_title' => $job_post_detail->job_title,
					'location' => $job_post_detail->location ?? null,
					'vacancy' => $job_post_detail->vacancy ?? null,
					'experience' => $job_post_detail->experience->name ?? null,
					'marital_status' => $job_post_detail->marital_status->pluck('name')->implode(',') ?? [],
					'state' => $job_post_detail->state->name ?? null,
					'city' => $job_post_detail->city->name ?? null,
					'job_post_gender' => $job_post_gender ?? null,
					'minimum_salary' => $job_post_detail->minimum_salary ?? null,
					'maximum_salary' => $job_post_detail->maximum_salary ?? null,
					'is_age_limit' => $job_post_detail->is_age_limit,
					'job_description' => $job_post_detail->job_description ?? null,
					'qualification' => $job_post_detail->qualification->pluck('name')->implode(',') ?? null,
					'functional_area' => $job_post_detail->functional_area->pluck('name')->implode(',') ?? null,
					'job_type' => $job_post_detail->job_type->pluck('name')->implode(',') ?? null,
					'skill' => $job_post_detail->skill->pluck('name')->implode(',') ?? null,
					'known_languages' => $job_post_detail->known_languages->pluck('name')->implode(',') ?? null,
					'category' => $job_post_detail->category->pluck('name')->implode(',') ?? null,
					// 'career_level' => 	$job_post_detail->career_level->pluck('name')->implode(',') ?? null,
					'shift' => $job_post_detail->shift->pluck('name')->implode(',') ?? null,
					'is_shortlisted' => $shortlisted
				];
			}

				if($job_seeker_detail->work_experience != ""){
					foreach($job_seeker_detail->work_experience as $work_experience)
					{
						$date = null;
						$start_time = null;
						$end_time = null;

						$start_time = strtotime($work_experience->start_date);
						$end_time = ($work_experience->end_date != "") ? strtotime($work_experience->end_date) : time();
						$date = humanTiming($start_time,$end_time);

						$short_experience[] = [
							'job_title' => $work_experience->position,
							'date' => $date
						];
					}
				}

				$qualification_start_date = 'N/A';
				$qualification_end_date = 'N/A';

				if($job_seeker_detail->qualification->first()){

					if($job_seeker_detail->qualification->first()->start_date){
						$qualification_start_date = date('Y',strtotime($job_seeker_detail->qualification->first()->start_date));
					}

					if($job_seeker_detail->qualification->first()->end_date){
						$qualification_end_date = date('Y',strtotime($job_seeker_detail->qualification->first()->end_date));
					}
				}

				if($job_seeker_detail->work_experience != ""){
					foreach($job_seeker_detail->work_experience as $work_experience){
						$long_work_experience[] = [
							'id' => $work_experience->id,
							'user_id' => $work_experience->user_id,
							'position' => $work_experience->position,
							'where_did_you_work' => $work_experience->where_did_you_work,
							'address' => $work_experience->address,
							'start_date' => ($work_experience->start_date != "") ? date('d-m-Y',strtotime($work_experience->start_date)) : null,
							'current_work_here' => $work_experience->current_work_here,
							'end_date' => ($work_experience->end_date != "") ? date('d-m-Y',strtotime($work_experience->end_date)) : null,
						];
					}
				}
				// dd();
				// dd($job_seeker_detail->qualification->qualificationDetail);
				$toReturn = [
					'name' => $job_seeker_detail->name ?? '',
					'email' => $job_seeker_detail->email ?? '',
					'mobile' => $job_seeker_detail->mobile ?? '',
					'profile_image' => $job_seeker_detail->job_seeker_profile_image ?? '',
					'address' => $job_seeker_detail->address ?? '',
					'milestone' => $job_seeker_detail->milestone ?? '',
					'profile_progress' => $job_seeker_detail->profile_progress,
					'state' => $job_seeker_detail->state->name ?? '',
					'city' => $job_seeker_detail->city->name ?? '',
					'is_profile_complete' => ($job_seeker_detail->profile_progress > 60) ? 1 : 0,
					'pincode' => $job_seeker_detail->pin_code ?? '',
					'gender' => ($job_seeker_detail->gender == 'M') ? 'Male' : 'Female',
					'expected_salary' => $job_seeker_detail->expected_salary ?? '',
					'marital_status' => $job_seeker_detail->maritalStatus->name ?? '',
					'date_of_birth' => ($job_seeker_detail->date_of_birth != "") ? date('d-m-Y',strtotime($job_seeker_detail->date_of_birth)) : null,
					'expected_salary' => $job_seeker_detail->expected_salary.'('.$job_seeker_detail->salary_type.')',
					'long_work_experience' => $long_work_experience ?? [],
					'short_experience' => $short_experience ?? [],
					// 'career_level' => $job_seeker_detail->career_level->name ?? '',
					'job_preference' => $job_seeker_detail->category->pluck('name')->implode(',') ?? '',
					'preferred_location' => $job_seeker_detail->preferred_location->pluck('name')->implode(',') ?? '',
					'school_name' => ($job_seeker_detail->qualification->count() != 0) ? $job_seeker_detail->qualification->first()->school_name : 'N/A',
					'qualification_level' => ($job_seeker_detail->qualification->count() != 0) ? $job_seeker_detail->qualification->first()->qualificationDetail->name : 'N/A',
					'field_of_study' => ($job_seeker_detail->qualification->count() != 0) ? $job_seeker_detail->qualification->first()->field_of_study : 'N/A',
					// 'qualification_start_date' => ($job_seeker_detail->qualification->count() != 0) ? ($job_seeker_detail->qualification->first()->start_date != "") ? date('d-m-Y', strtotime($job_seeker_detail->qualification->first()->start_date)) : 'N/A' : 'N/A',
					'qualification_start_date' => $qualification_start_date,
					'current_study_here' => ($job_seeker_detail->qualification->count() != 0) ? $job_seeker_detail->qualification->first()->current_study_here : 'N/A',
					// 'qualification_end_date' => ($job_seeker_detail->qualification->count() != 0) ? ($job_seeker_detail->qualification->first()->end_date != "") ? date('d-m-Y', strtotime($job_seeker_detail->qualification->first()->end_date)) : 'N/A' : 'N/A',
					'qualification_end_date' => $qualification_end_date,
					'functional_area' => $job_seeker_detail->functional_area->pluck('name')->implode(',') ?? '',
					'job_type' => $job_seeker_detail->job_type->pluck('name')->implode(',') ?? '',
					'skill' => $job_seeker_detail->skill->pluck('name')->implode(',') ?? '',
					'known_languages' => $job_seeker_detail->known_languages->pluck('name')->implode(',') ?? '',
					'interests' => $job_seeker_detail->interests->pluck('name')->implode(',') ?? '',
					'locality_id' => $job_seeker_detail->locality_id->name ?? '',
					'salary_type' => $job_seeker_detail->salary_type,
					'job_detail' => $job_detail ?? null
				];

			$this->data = $toReturn;
		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function employerJobSeekerSearch(Request $request){
		try{

			$search_value = $request->user;

			$search_result = User::with(['qualification','work_experience'])->when($search_value, function ($query, $search_value) {
				return $query->where('name', 'LIKE', "%{$search_value}%");
			})
			->select('id','profile_image','name','expected_salary','salary_type')
			->paginate(10)
			->toArray();

			function humanTiming ($start_time,$end_time)
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

			foreach($search_result['data'] as $key => $search ){

				$short_experience = [];
				$date = null;
				$start_time = null;
				$end_time = null;

				if($search_result['data'][$key]['work_experience'] != ""){

					foreach($search_result['data'][$key]['work_experience'] as $work_experience)
					{
						$work_experience_start_date = $work_experience['start_date'];
						$start_time = strtotime($work_experience_start_date);
						$end_time = ($work_experience['end_date'] != null) ? strtotime($work_experience['end_date']) : time();
						$date = humanTiming($start_time,$end_time);

						$short_experience[] = [
							'experience' => $work_experience['position'].' - '.$date
						];
					}
				}

				$search_result['data'][$key]['id'] = $search_result['data'][$key]['id'];
				$search_result['data'][$key]['profile_image'] = $search_result['data'][$key]['profile_image'];
				$search_result['data'][$key]['name'] = $search_result['data'][$key]['name'];
				$search_result['data'][$key]['expected_salary'] = $search_result['data'][$key]['expected_salary'];
				$search_result['data'][$key]['user_experience'] = collect($short_experience)->pluck('experience')->implode(',') ?? 'N/A';
				$search_result['data'][$key]['salary_type'] = $search_result['data'][$key]['salary_type'];
				$search_result['data'][$key]['qualification'] = $search_result['data'][$key]['qualification']['field_of_study'];

				unset($search_result['data'][$key]['work_experience']);
			}

			$this->data = $search_result;
		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function viewMoreCandidate(Request $request){
		try{

			$user = $this->currentuser();
			
			$user_category = $user->category->pluck('id')->toArray();
			$job_city_id = $user->user_job_post->where('is_status','Approved')->pluck('city_id')->toArray();
			$job_state_id = $user->user_job_post->where('is_status','Approved')->pluck('state_id')->toArray();

			$job_gender = $user->user_job_post->where('is_status','Approved')->pluck('gender')->implode(',');
			$job_gender = array_unique(explode(',',$job_gender));

			$user_job_post = $user->user_job_post->where('is_status','Approved')->pluck('id')->toArray();

			$job_category = JobPost::with('category','skill')
									->whereIn('id',$user_job_post)
									->get();
									
			$job_state = State::with('city')
									->whereIn('id',$job_state_id)
									->get();

			$category = [];
			$skill = [];
			$city = [];

			
			foreach($job_state as $item){

				if($item->city->count() > 0){
					$city_aaray = $item->city->pluck('id')->toArray();
					$city = array_unique(array_merge($city,$city_aaray));
				}
				
			}
			
			foreach($job_category as $item){
				
				$cat_aaray = $item->category->pluck('id')->toArray();
				$category = array_unique(array_merge($category,$cat_aaray));
				
				if($item->skill->count() > 0){
					$skill_aaray = $item->skill->pluck('id')->toArray();
					$skill = array_unique(array_merge($skill,$skill_aaray));
				}
				
			}
			
			$feactured_candicate_array = Payment::whereNull('job_id')->pluck('user_id');
			
			$qualification_array = JobSeekerQualification::pluck('user_id')->toArray();
			$home_page_banners = Homepagebanner::get();

			$bannerToReturn = [];

			foreach ($home_page_banners as $key => $home_page_banner) {
				$bannerToReturn[] = [
					'id' => $home_page_banner->id,
					'file_name' => $home_page_banner->slider_img,
					'file_path' => $home_page_banner->banner_image
				];
			}

			$first_array = User::with('category')->whereHas('category',function($category_query) use ($user_category){
									$category_query->whereIn('category_id',$user_category);
								})
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes']);
			

			$second_array = User::with('category')->whereHas('category',function($category_query) use ($category){
									$category_query->whereIn('category_id',$category);
								})
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes']);

			$third_array = User::whereHas('category',function($category_query) use ($category){
									$category_query->whereIn('category_id',$category);
								})
								->when($city,function($city_query) use ($city){
									$city_query->whereIn('city_id',$city);
								})

								->where(function($query) use ($skill){

									$query->orWhereHas('skill',function($skill_query) use($skill){
										$skill_query->orWhereIn('skill_id',$skill);
									});

								})
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes']);
								
			$fourth_array = User::whereHas('category',function($category_query) use ($category){
									$category_query->whereIn('category_id',$category);
								})
								->when($city,function($city_query) use ($city){
									$city_query->whereIn('city_id',$city);
								})

								->where(function($query) use ($skill){

									$query->orWhereHas('skill',function($skill_query) use($skill){
										$skill_query->whereIn('skill_id',$skill);
									});

								})
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes']);

			$view_more_candidates = User::whereHas('category',function($category_query) use ($category){
									$category_query->whereIn('category_id',$category);
								})
								->when($job_city_id,function($city_query) use ($job_city_id){
									$city_query->whereIn('city_id',$job_city_id);
								})
								->when($job_gender,function($gender_query) use ($job_gender){
									$gender_query->whereIn('gender',$job_gender);
								})
								->whereHas('skill',function($skill_query) use ($skill){
									$skill_query->whereIn('skill_id',$skill);
								})
								->latest()
								->take(7)
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes']);	
								
			$feacture_candidate = User::whereHas('category',function($category_query) use ($user_category){
									$category_query->whereIn('category_id',$user_category);
								})
								->orderBy('created_at','DESC')
								->union($view_more_candidates)
								->union($fourth_array)
								->union($third_array)
								->union($second_array)
								->union($first_array)
								->whereIn('id',$feactured_candicate_array)
								->with(['work_experience','qualification','is_featured'])
								->where(['user_type'=>'JOBSEEKER','is_active'=>'Yes'])
								->paginate(10)
								->toArray();

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

			foreach($feacture_candidate['data'] as $key => $view_more_candidate){

				$short_experience = null;
				$date = null;
				$start_time = null;
				$end_time = null;


				$is_feactured = 0;
				
				if($feacture_candidate['data'][$key]['is_featured'] > 0){
					if($feacture_candidate['data'][$key]['is_featured']['user_id'] == $feacture_candidate['data'][$key]['id']){
						$is_feactured = 1;
					}
				}

				if(count($feacture_candidate['data'][$key]['work_experience']) > 0){

					foreach($feacture_candidate['data'][$key]['work_experience'] as $work_experience)
					{
						
						$short_experience = collect($feacture_candidate['data'][$key]['work_experience'])->first();
						$short_experience = $short_experience['position'].' '.humanTiming($short_experience['start_date'],$short_experience['end_date']);
						// $work_experience_start_date = $work_experience['start_date'];
						// $start_time = strtotime($work_experience_start_date);
						// $end_time = ($work_experience['end_date'] != null) ? strtotime($work_experience['end_date']) : time();
						// $date = humanTimings($start_time,$end_time);

						// $short_experience[] = [
						// 	'experience' => $work_experience['position'].' - '.$date
						// ];
					}
				}
;
				$feacture_candidate['data'][$key]['profile_image'] = $feacture_candidate['data'][$key]['profile_image'] ?? null;
				$feacture_candidate['data'][$key]['name'] = $feacture_candidate['data'][$key]['name'] ?? null;
				$feacture_candidate['data'][$key]['expected_salary'] = $feacture_candidate['data'][$key]['expected_salary'] ?? null;
				$feacture_candidate['data'][$key]['address'] = $feacture_candidate['data'][$key]['address'] ?? null;
				$feacture_candidate['data'][$key]['salary_type'] = $feacture_candidate['data'][$key]['salary_type'] ?? null;
				$feacture_candidate['data'][$key]['qualification'] = $feacture_candidate['data'][$key]['qualification']['field_of_study'] ?? null;
				$feacture_candidate['data'][$key]['is_feactured'] = $is_feactured;
				$feacture_candidate['data'][$key]['user_experience'] = $short_experience;

				unset($feacture_candidate['data'][$key]['work_experience'],$feacture_candidate['data'][$key]['is_featured']);
			}

			$this->data = $feacture_candidate;
		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function employerWorkspacePhoto(Request $request){
		try{
			$user = $this->currentuser();

			// dd($user->user_workspace_photo);
			$work_space_photo = $user->user_workspace_photo;

			$this->data = $work_space_photo;
		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function storeEmployerWorkspacePhoto(Request $request){
		try{

			$user = $this->currentuser();

			if ($request->hasFile('workspace_photo')) {

				foreach ($request->workspace_photo as $workspace_file) {

					$workspace_photo_name = time() . '_' . rand(0, 500) . '_' . $workspace_file->getClientOriginalName();

					$workspace_photo_name = str_replace(' ', '_', $workspace_photo_name);

					$workspace_file->storeAs('workspace_photo/', $workspace_photo_name);

					$add = new UserWorksapcePhoto;
					$add->user_id = $user->id;
					$add->workspace_photo = $workspace_photo_name;
					$add->save();
				}
			}
			$work_space_photo = $user->user_workspace_photo;

			$this->data = $work_space_photo;

		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

}
