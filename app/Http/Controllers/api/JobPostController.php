<?php

namespace App\Http\Controllers\api;

use DB;
use App\User;
use Exception;
use App\Model\City;
use App\Model\State;
use App\Model\Skills;
use App\Model\Shifts;
use App\Model\JobPost;
use App\Model\JobType;
use App\Model\Category;
use App\Model\Locality;
use App\Model\Experience;
use App\Model\Industries;
use App\Model\CompanyType;
use App\Model\UserJobApply;
use App\Model\CareerLevels;
use App\Model\CategorySkill;
use App\Model\MaritalStatus;
use App\Model\KnowledgeBank;
use App\Model\Qualification;
use Illuminate\Http\Request;
use App\Model\Homepagebanner;
use App\Model\FunctionalArea;
use App\Model\KnownLanguages;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Model\Payment;
use App\Model\Salary;
use App\Model\Setting;
use App\Model\TeacherAttribute;
use Illuminate\Support\Facades\Validator;

class JobPostController extends ApiController
{
	public function getQualificationList(Request $request)
	{
		try {

			$qualification_list = Qualification::select('id', 'name', 'is_show_in_feild_of_study')->where('is_active', 'Yes')->get();
			$this->data = $qualification_list;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
    }

    public function getSalaryList(Request $request)
	{
		try {

			$salary_list = Salary::select('id', 'salary')->where('is_active', 'Yes')->get();
			$this->data = $salary_list;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getExperience(Request $request)
	{
		try {

			$experience_list = Experience::select('id', 'name')->where('is_active', 'Yes')->select('id', 'name')->get();
			$this->data = $experience_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getLanguages(Request $request)
	{
		try {

			$languages_list = KnownLanguages::select('id', 'name')->where('is_active', 'Yes')->select('id', 'name')->get();
			$this->data = $languages_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getSkill(Request $request)
	{
		try {
			$category = $request->category;

			$skill_list = Skills::whereHas('category', function ($query) use ($category) {
				$query->whereIn('category_id', $category);
			})
			->select('id', 'name')
			->where('is_active', 'Yes')
			->get();

			// $skill_list = Skills::select('id', 'name')->where('is_active', 'Yes')->get();

			$this->data = $skill_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getJobType(Request $request)
	{
		try {

			$job_type_list = JobType::select('id', 'name')->where('is_active', 'Yes')->select('id', 'name')->get();
			$this->data = $job_type_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getCareerLevel(Request $request)
	{
		try {

			$career_level_list = CareerLevels::select('id', 'name')->where('is_active', 'Yes')->select('id', 'name')->get();
			$this->data = $career_level_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getFunctionalArea(Request $request)
	{
		try {

			$functional_area_list = FunctionalArea::select('id', 'name')->where('is_active', 'Yes')->select('id', 'name')->get();
			$this->data = $functional_area_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getIndustries(Request $request)
	{
		try {
			$industries_list = Industries::select('id', 'name')
				->where('is_active', 'Yes')
				->get();
			$this->data = $industries_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getMaritalStatus(Request $request)
	{
		try {

			$marital_status_list = MaritalStatus::select('id', 'name')->where('is_active', 'Yes')->select('id', 'name')->get();
			$this->data = $marital_status_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getState(Request $request)
	{
		try {

			$state_list = State::select('id', 'name')->where('is_active', 'Yes')->select('id', 'name')->get();
			$this->data = $state_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getCity($id)
	{
		try {
			$city_list = City::where(['is_active' => 'Yes', 'state_id' => $id])->select('id', 'name')->get();
			$this->data = $city_list;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}

		return $this->responseSuccess();
	}

	public function getShift(Request $request)
	{
		try {

			$shift_list = Shifts::select('id', 'name')->where('is_active', 'Yes')->select('id', 'name')->get();
			$this->data = $shift_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function storeJobPost(Request $request)
	{
		$user = $this->currentuser();
		try {
			$validator = Validator::make($request->all(), [
				'job_title' => 'required|max:150',
				// 'job_description' => 'required',
				'location' => 'required',
				'vacancy' => 'required|numeric',
				'gender' => 'required',
				'minimum_salary' => 'required',
				'maximum_salary' => 'required',
				// 'qualification' => 'required',
				'experience_id' => 'required',
				// 'known_languages' => 'required',
				'skill' => 'required',
				'job_type' => 'required',
				// 'career_level' => 'required',
				// 'functional_area' => 'required',
				'category' => 'required',
				// 'shift.*' => 'required',
				'marital_status.*' => 'required',
				'state_id' => 'required',
				'city_id' => 'required',
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$job_post = new JobPost;
			$job_post->user_id = $user->id ?? 0;
			$job_post->job_title = $request->job_title;
			$job_post->job_description = $request->job_description ?? null;
			$job_post->location = $request->location;
			$job_post->vacancy = $request->vacancy;
			$job_post->gender = $request->gender;
			$job_post->experience_id = $request->experience_id;
			// $job_post->marital_status_id = $request->marital_status_id ?? null;
			$job_post->state_id = $request->state_id ?? $user->state_id;
			$job_post->city_id = $request->city_id ?? $user->city_id;
			$job_post->minimum_salary = $request->minimum_salary;
			$job_post->maximum_salary = $request->maximum_salary;

			if ($request->age_limit == 1) {
				$job_post->is_age_limit = $request->age_limit;
				$job_post->age_limit = $request->limit;
			}

			$job_post->save();

			if ($request->job_type != "") {
				$job_post->job_type()->attach($request->job_type);
			}
			if ($request->skill != "") {
				$job_post->skill()->attach($request->skill);
			}
			if ($request->known_languages != "") {
				$job_post->known_languages()->attach($request->known_languages);
			}

			if ($request->shift != "") {
				$job_post->shift()->attach($request->shift);
			}

			if ($request->marital_status != "") {
				$job_post->marital_status()->attach($request->marital_status);
			}

			// if ($request->industries != "") {
			// 	$job_post->industries()->attach($request->industries);
			// }

			if ($request->category != "") {
				$job_post->category()->attach($request->category);
			}

			// if ($request->career_level != "") {
			// 	$job_post->career_level()->attach($request->career_level);
			// }

			if ($request->qualification != "") {
				$job_post->qualification()->attach($request->qualification);
			}
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccessWithoutDataObject();
	}
	//Edit job post
	public function editPostDetail(Request $request)
	{
		try {
			$salary_limit = Setting::select('minimum_salary','maximum_salary')->first();

			$job_post_detail = JobPost::with([
				"qualification:qualification_id as id,name",
				"experience:id,name",
				"known_languages:known_languages_id as id,name",
				"skill:skill_id as id,name",
				"job_type:job_type_id as id,name",
				// "career_level:career_level_id as id,name",
				"shift:shift_id as id,name",
				// "functional_area:functional_area_id as id,name",
				"category:category_id as id,name",
				"marital_status:marital_status_id as id,name",
				"state:id,name",
				"city:id,name"
			])->find($request->id);

			$job_post_detail_arr = [
				'id' => $job_post_detail->id,
				'job_title' => $job_post_detail->job_title ?? null,
				'job_description' => $job_post_detail->job_description ?? null,
				'location' => $job_post_detail->location ?? null,
				'vacancy' => $job_post_detail->vacancy ?? null,
				'gender' => $job_post_detail->gender ?? null,
				'experience_id' => $job_post_detail->experience_id ?? null,
				'experience_name' => $job_post_detail->experience->name ?? null,
				// 'marital_status_id' => $job_post_detail->marital_status_id ?? null,
				// 'marital_status_name' => $job_post_detail->marital_status->name ?? null,
				'state_id' => $job_post_detail->state_id ?? null,
				'state_name' => $job_post_detail->state->name ?? null,
				'city_id' => $job_post_detail->city_id ?? null,
				'city_name' => $job_post_detail->city->name ?? null,
				'minimum_salary' => $job_post_detail->minimum_salary ?? null,
				'maximum_salary' => $job_post_detail->maximum_salary ?? null,
				'is_age_limit' => $job_post_detail->is_age_limit,
				'age_limit' => ($job_post_detail->age_limit == null) ? 0 : $job_post_detail->age_limit,
				'shift' => $job_post_detail->shift ?? [],
				// 'career_level' => $job_post_detail->career_level ?? [],
				'marital_status' => $job_post_detail->marital_status ?? [],
				'known_languages' => $job_post_detail->known_languages ?? [],
				'skill' => $job_post_detail->skill ?? [],
				'job_type' => $job_post_detail->job_type ?? [],
				'category' => $job_post_detail->category ?? [],
				'qualification' => $job_post_detail->qualification ?? [],
				'limit_minimum_salary' => $salary_limit->minimum_salary ?? '',
				'limit_maximum_salary' => $salary_limit->maximum_salary ?? ''
			];
			$this->data = $job_post_detail_arr;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function updateJobPost(Request $request)
	{
		$user = $this->currentuser();
		try {
			$validator = Validator::make($request->all(), [
				'job_title' => 'required|max:150',
				// 'job_description' => 'required',
				'location' => 'required',
				'vacancy' => 'required|numeric',
				'gender' => 'required',
				'minimum_salary' => 'required',
				'maximum_salary' => 'required',
				// 'qualification' => 'required',
				'experience_id' => 'required',
				// 'known_languages' => 'required',
				'skill' => 'required',
				'job_type' => 'required',
				// 'career_level.*' => 'required',
				// 'functional_area' => 'required',
				'category' => 'required',
				// 'shift.*' => 'required',
				// 'marital_status_id' => 'required',
				'state_id' => 'required',
				'city_id' => 'required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$job_post = JobPost::findorfail($request->id);
			$job_post->user_id = $user->id ?? 0;
			$job_post->job_title = $request->job_title;
			$job_post->job_description = $request->job_description ?? null;
			$job_post->location = $request->location;
			$job_post->vacancy = $request->vacancy;
			$job_post->gender = $request->gender;
			$job_post->experience_id = $request->experience_id;
			// $job_post->marital_status_id = $request->marital_status_id ?? null;
			$job_post->state_id = $request->state_id ?? $user->state_id;
			$job_post->city_id = $request->city_id ?? $user->city_id;
			$job_post->minimum_salary = $request->minimum_salary;
			$job_post->maximum_salary = $request->maximum_salary;
			if ($request->age_limit == 1) {
				$job_post->is_age_limit = $request->age_limit;
				$job_post->age_limit = $request->limit;
			}
			$job_post->save();

			if ($request->qualification != "") {
				$job_post->qualification()->sync($request->qualification);
			}
			if ($request->skill != "") {
				$job_post->skill()->sync($request->skill);
			}
			if ($request->known_languages != "") {
				$job_post->known_languages()->sync($request->known_languages);
			}
			if ($request->marital_status != "") {
				$job_post->marital_status()->sync($request->marital_status);
			}
			// if ($request->career_level != "") {
			// 	$job_post->career_level()->sync($request->career_level);
			// }

			if ($request->shift != "") {
				$job_post->shift()->sync($request->shift);
			}

			if ($request->job_type != "") {
				$job_post->job_type()->sync($request->job_type);
			}
			if ($request->category != "") {
				$job_post->category()->sync($request->category);
			}
			// if ($request->industries != "") {
			// 	$job_post->industries()->sync($request->industries);
			// }
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccessWithoutDataObject();
	}

	public function deleteJobPostDetail(Request $request)
	{
		$user = $this->currentuser();
		try {
			$job_post = JobPost::findorfail($request->id);
			$job_post->qualification()->detach();
			$job_post->skill()->detach();
			$job_post->known_languages()->detach();
			$job_post->job_type()->detach();
			$job_post->category()->detach();
			$job_post->marital_status()->detach();
			// $job_post->career_level()->detach();
			$job_post->shift()->detach();
			// $job_post->industries()->detach();
			$job_post->delete();
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccessWithoutDataObject();
	}

	public function closeJobPost(Request $request)
	{
		$user = $this->currentuser();

		try {

			$job_post = JobPost::findorfail($request->id);
			$job_post->is_status = 'Expired';
			$job_post->save();

		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccessWithoutDataObject();
	}

	public function getCategoryList(Request $request)
	{
		try {
			$user = $this->currentuser();

			$category_list = Category::leftJoin('category_user', function ($join) use ($user) {
				$join->on('categories.id', '=', 'category_user.category_id')
					->where('category_user.user_id', '=', $user->id);
				})
				->with(['children'])
				->select('id', 'name', 'category_user.user_id AS is_selected','is_teacher')
				->get();

			$this->data = $category_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getCategoryAttribute(Request $request)
	{
		try {
			$user = $this->currentuser();

			$standard = TeacherAttribute::where('category_id',$request->id)->select('id','category_id','name')->get();

			$medium = [
				0 => 'Gujarati',
				1 => 'English'
			];

			$timing = [
				0 => 'Morning',
				1 => 'Afternoon',
				2 => 'Evening',
				3 => 'Full day'
			];

			$online_teaching_experience = [
				0 => 'Yes',
				1 => 'No'
			];

			$toReturn = [
				'standard' => $standard ?? [],
				'medium' => $medium ?? [],
				'timing' => $timing ?? [],
				'online_teaching_experience' => $online_teaching_experience ?? []
			];

			$this->data = $toReturn;

		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getCategory(Request $request)
	{
		$id = $request->id;
		try {

			$category_list = Category::with('skill')->find($id);
			$this->data = $category_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}


	public function jobPostDetail($id)
	{
		$user = $this->currentuser();

		try {

			$job_post_detail = JobPost::with([
				"qualification:name",
				"experience:id,name",
				"known_languages:name",
				"skill:name",
				"job_type:name",
				// "career_level:id,name",
				"functional_area:name",
				"industries:name",
				// "shift:id,name",
				"marital_status:name",
				"state:id,name",
				"city:id,name"
			])->find($id);

			if ($user->user_type == "JOBSEEKER") {

				$similar_jobs = JobPost::with(['industries' => function ($query) use ($id) {
					$query->where('job_post_id', '!=', $id);
					$query->where('industries_id', $id);
				}])
				->where('is_status','Approved')
				->inRandomOrder()
				->limit(6)
				->get();

				$similar_job_array = [];

				foreach ($similar_jobs as $key => $similar_job) {

					if ($similar_job->user != "") {
						$company_logo = '';
						if ($similar_job->user->profile_image != NULL && $similar_job->user->profile_image != "") {
							$company_logo =  asset('storage/profile_image/' . $similar_job->user->profile_image);
						} else {
							$company_logo = null;
						}
					}


					$similar_job_array[] = [
						'id' => $similar_job->id,
						'company_logo' => $company_logo ?? null,
						'job_title' => $similar_job->job_title,
						'company_name' => $similar_job->user->name ?? null,
						'location' => $similar_job->location
					];
				}
			}


			function humanTimings($time)
			{

				$time = time() - $time;
				$time = ($time < 1) ? 1 : $time;
				$tokens = array(
					31536000 => 'year',
					2592000 => 'month',
					604800 => 'week',
					86400 => 'day',
					3600 => 'hour',
					60 => 'minute',
					1 => 'second'
				);

				foreach ($tokens as $unit => $text) {
					if ($time < $unit) continue;
					$numberOfUnits = floor($time / $unit);
					return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
				}
			}

			$company_logo = '';
			if ($job_post_detail->user->profile_image != NULL && $job_post_detail->user->profile_image != "") {
				$company_logo =  asset('storage/profile_image/' . $job_post_detail->user->profile_image);
			} else {
				$company_logo = null;
			}

			$gender = '';

			if ($job_post_detail->gender == 'M') {
				$gender = 'Male';
			} elseif ($job_post_detail->gender == 'F') {
				$gender = 'Female';
			} elseif ($job_post_detail->gender == 'M,F' || $job_post_detail->gender == 'F,M') {
				$gender = 'Male - Female';
			}

			$is_edit = 0;
			$is_delete = 0;

			if($job_post_detail->is_status == 'Pending'){
				$is_edit = 1;
				$is_delete = 1;
			}elseif($job_post_detail->is_status == 'Approved'){
				$is_delete = 1;
			}

			$toReturn = [
				'id' => $job_post_detail->id,
				'job_title' => $job_post_detail->job_title,
				'company_name' => $job_post_detail->user->name ?? null,
				'company_email' => $job_post_detail->user->email ?? null,
				'company_mobile' => $job_post_detail->user->mobile ?? null,
				'company_logo' => $company_logo,
				'about_company' => $job_post_detail->about_company ?? null,
				'company_address' => $job_post_detail->user->address ?? '',
				'company_city' => ($job_post_detail->user->city->name ?? '') . '-' . $job_post_detail->user->pin_code,
				'company_state' => $job_post_detail->user->state->name ?? '',
				'job_description' => $job_post_detail->job_description,
				'job_preference' => $job_post_detail->category->pluck('name')->implode(',') ?? null,
				'location' => $job_post_detail->location,
				'vacancy' => $job_post_detail->vacancy,
				'gender' => $gender,
				'website_url' => $job_post_detail->user->city->website_url ?? null,
				'experience' => $job_post_detail->experience->name ?? null,
				// 'career_level' => $job_post_detail->career_level->pluck('name')->implode(',') ?? null,
				'shift' => $job_post_detail->shift->pluck('name')->implode(',') ?? null,
				'marital_status' => $job_post_detail->marital_status->pluck('name')->implode(',') ?? [],
				// 'marital_status' => $job_post_detail->marital_status->name ?? null,
				'state_id' => $job_post_detail->state_id ?? null,
				'state' => $job_post_detail->state->name ?? null,
				'city_id' => $job_post_detail->city_id ?? null,
				'city' => $job_post_detail->city->name ?? null,
				'minimum_salary' => $job_post_detail->minimum_salary,
				'maximum_salary' => $job_post_detail->maximum_salary,
				'is_age_limit' => $job_post_detail->is_age_limit,
				'age_limit' => $job_post_detail->age_limit,
				'qualification' => $job_post_detail->qualification->pluck('name')->implode(', ') ?? null,
				'category' => $job_post_detail->category->pluck('name')->implode(', ') ?? null,
				'skill' => $job_post_detail->skill->pluck('name')->implode(', ') ?? null,
				'known_languages' => $job_post_detail->known_languages->pluck('name')->implode(', ') ?? null,
				'job_type' => $job_post_detail->job_type->pluck('name')->implode(', ') ?? null,
				'industries' => $job_post_detail->industries->pluck('name')->implode(', ') ?? null,
				'date' => 'Posted ' . humanTimings(strtotime($job_post_detail->created_at)) . ' ago',
				'is_edit' => $is_edit,
				'is_delete' => $is_delete,

			];
			if ($user->user_type == "JOBSEEKER") {
				$similar_job = ['similar_job' => $similar_job_array];
				$toReturn = array_merge($toReturn,$similar_job);
			}

			$this->data = $toReturn;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getJobFilter(Request $request)
	{
		try {

			$user = $this->currentuser();

			$minimum_salary = $request->minimum_salary;
			$maximum_salary = $request->maximum_salary;
			$category = $request->category;
			$qualification = $request->qualification;
			$known_languages = $request->known_languages;
			$job_type = $request->job_type;
			$skill = $request->skill;
			// $career_level = $request->career_level;
			$shift = $request->shift;

			$job_post = JobPost::when($minimum_salary, function ($query, $minimum_salary) {
				return $query->where('minimum_salary', $minimum_salary);
			})
				->when($maximum_salary, function ($query, $maximum_salary) {
					return $query->where('maximum_salary', $maximum_salary);
				})
				// ->when($category, function ($query, $category) {
				// 	return $query->orWhereHas('category', function ($category_query) use ($category) {
				// 		$category_query->whereIn('category_id', $category);
				// 	});
				// })
				// ->when($qualification, function ($query, $qualification) {
				// 	return $query->orWhereHas('qualification', function ($qualification_query) use ($qualification) {
				// 		$qualification_query->whereIn('qualification_id', $qualification);
				// 	});
				// })
				// ->when($known_languages, function ($query, $known_languages) {
				// 	return $query->orWhereHas('known_languages', function ($known_languages_query) use ($known_languages) {
				// 		$known_languages_query->whereIn('known_languages_id', $known_languages);
				// 	});
				// })
				// ->when($job_type, function ($query, $job_type) {
				// 	return $query->orWhereHas('job_type', function ($job_type_query) use ($job_type) {
				// 		$job_type_query->whereIn('job_type_id', $job_type);
				// 	});
				// })
				// ->when($skill, function ($query, $skill) {
				// 	return $query->orWhereHas('skill', function ($skill_query) use ($skill) {
				// 		$skill_query->whereIn('skill_id', $skill);
				// 	});
				// })
				// ->when($shift, function ($query, $shift) {
				// 	return $query->orWhereHas('shift', function ($shift_query) use ($shift) {
				// 		$shift_query->whereIn('shift_id', $shift);
				// 	});
				// })
				->when($category, function ($query, $category) {
					return $query->whereHas('category', function ($category_query) use ($category) {
						$category_query->whereIn('category_id', $category);
					});
				})
				->when($qualification, function ($query, $qualification) {
					return $query->whereHas('qualification', function ($qualification_query) use ($qualification) {
						$qualification_query->whereIn('qualification_id', $qualification);
					});
				})
				->when($known_languages, function ($query, $known_languages) {
					return $query->whereHas('known_languages', function ($known_languages_query) use ($known_languages) {
						$known_languages_query->whereIn('known_languages_id', $known_languages);
					});
				})
				->when($job_type, function ($query, $job_type) {
					return $query->whereHas('job_type', function ($job_type_query) use ($job_type) {
						$job_type_query->whereIn('job_type_id', $job_type);
					});
				})
				->when($skill, function ($query, $skill) {
					return $query->whereHas('skill', function ($skill_query) use ($skill) {
						$skill_query->whereIn('skill_id', $skill);
					});
				})
				->when($shift, function ($query, $shift) {
					return $query->whereHas('shift', function ($shift_query) use ($shift) {
						$shift_query->whereIn('shift_id', $shift);
					});
				})
				->with([
					'job_type:id,name',
					'experience:id,name',
					'user:id,name,profile_image',
					'user_shortlist' => function($query) use ($user){
						$query->where('user_id',$user->id);
					}
				])
				->select('id','job_title','user_id','location','experience_id','minimum_salary','maximum_salary')
				->where(['is_active'=>'Yes','is_status'=>'Approved'])
				->paginate(10)
				->toArray();

				foreach ($job_post['data'] as $key => $search) {
					$applied = '';
					$shortlisted = '';
					// dd($job_post['data'][$key]['user_shortlist']);
					$user_job_apply = $job_post['data'][$key]['user_shortlist'];

					if ($user_job_apply != '' && $user_job_apply['is_wishlist'] == 1) {
						$shortlisted = '1';
					} elseif ($user_job_apply != '' && $user_job_apply['is_wishlist'] == '') {
						$applied = '1';
					}

					// $company_logo = '';
					if ($job_post['data'][$key]['user']['profile_image'] != NULL && $job_post['data'][$key]['user']['profile_image'] != "") {
						$company_logo =  asset('storage/profile_image/' . $job_post['data'][$key]['user']['profile_image']);
					} else {
						$company_logo = null;
					}

					// dd($job_post['data'][$key]['job_type']);
					$job_post['data'][$key]['id'] = $job_post['data'][$key]['id'];
					$job_post['data'][$key]['job_title'] = $job_post['data'][$key]['job_title'];
					$job_post['data'][$key]['location'] = $job_post['data'][$key]['location'];
					$job_post['data'][$key]['experience'] = $job_post['data'][$key]['experience']['name'];
					$job_post['data'][$key]['job_type'] = collect($job_post['data'][$key]['job_type'])->pluck('name')->implode(',');
					$job_post['data'][$key]['salary'] = $job_post['data'][$key]['minimum_salary'] . ' - ' . $job_post['data'][$key]['maximum_salary'];
					$job_post['data'][$key]['company_name'] = $job_post['data'][$key]['user']['name'];
					$job_post['data'][$key]['company_logo'] = $company_logo;
					$job_post['data'][$key]['is_applied'] = $applied;
					$job_post['data'][$key]['is_shortlisted'] = $shortlisted;

					unset($job_post['data'][$key]['minimum_salary'],$job_post['data'][$key]['user'],$job_post['data'][$key]['maximum_salary'],$job_post['data'][$key]['user_shortlist']);
				}
			$this->data = $job_post;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getJobApply(Request $request)
	{
		try {

			$user_job_apply = UserJobApply::where('user_id', $request->id)
				->with(['user:id,name', 'job_post:id,job_title'])
				->paginate(10);

			$this->data = $user_job_apply;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getSimilarJob(Request $request)
	{
		$user = $this->currentuser();

		try {

			$similar_jobs = JobPost::with(['industries'])->get();

			$this->data = $similar_jobs;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getCompanyType(Request $request)
	{
		try {

			$compnay_type_list = CompanyType::select('id', 'company_type AS name')->where('is_active', 'Yes')->get();

			$this->data = $compnay_type_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getLocality($city_id)
	{
		try {

			$locality_list = Locality::select('id', 'name')->where(['is_active' => 'Yes', 'city_id' => $city_id])->get();
			$this->data = $locality_list;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function searchJob(Request $request)
	{
		try {

			$search = $request->search;
			$user = $this->currentuser();

			$search_result = JobPost::when($search, function ($query, $search) {
				return $query->where('job_title', 'LIKE', "%{$search}%");
			})
			->with([
				'job_type:id,name',
				'category:id,name',
				'experience:id,name',
				'user:id,name,profile_image',
				'user_shortlist' => function($query) use ($user){
					$query->where('user_id',$user->id);
				}
			])
			->select('id','job_title','user_id','location','experience_id','minimum_salary','maximum_salary')
			->paginate(10)
			->toArray();

			foreach ($search_result['data'] as $key => $search) {
				$applied = '';
				$shortlisted = '';

				$user_job_apply = $search_result['data'][$key]['user_shortlist'];

				if ($user_job_apply != '' && $user_job_apply['is_wishlist'] == 1) {
					$shortlisted = '1';
				} elseif ($user_job_apply != '' && $user_job_apply['is_wishlist'] == '') {
					$applied = '1';
				}

				// $company_logo = '';
				if ($search_result['data'][$key]['user']['profile_image'] != NULL && $search_result['data'][$key]['user']['profile_image'] != "") {
					$company_logo =  asset('storage/profile_image/' . $search_result['data'][$key]['user']['profile_image']);
				} else {
					$company_logo = null;
				}

				// dd($search_result['data'][$key]['job_type']);
				$search_result['data'][$key]['job_title'] = $search_result['data'][$key]['job_title'];
				$search_result['data'][$key]['location'] = $search_result['data'][$key]['location'];
				$search_result['data'][$key]['experience'] = $search_result['data'][$key]['experience']['name'];
				$search_result['data'][$key]['job_type'] = collect($search_result['data'][$key]['job_type'])->pluck('name')->implode(',');
				$search_result['data'][$key]['category'] = collect($search_result['data'][$key]['category'])->pluck('name')->implode(',');
				$search_result['data'][$key]['salary'] = $search_result['data'][$key]['minimum_salary'] . ' - ' . $search_result['data'][$key]['maximum_salary'];
				$search_result['data'][$key]['company_name'] = $search_result['data'][$key]['user']['name'];
				$search_result['data'][$key]['company_logo'] = $company_logo;
				$search_result['data'][$key]['is_applied'] = $applied;
				$search_result['data'][$key]['is_shortlisted'] = $shortlisted;

				unset($search_result['data'][$key]['minimum_salary'],$search_result['data'][$key]['user'],$search_result['data'][$key]['maximum_salary']);
			}

			$this->data = $search_result;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function viewMoreJob(Request $request)
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
			
			$feactured_jobs_array = Payment::whereNotNull('job_id')->pluck('job_id');
			
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
					

			$view_more_jobs = JobPost::whereHas('category',function($category_query) use ($user_category){
							$category_query->whereIn('category_id',$user_category);
						})
						->where(['city_id' => $user_location])

						->when(($user_gender),function($gender_query) use ($user_gender){
							$gender_query->whereRaw("find_in_set('$user_gender',gender)");
						})

						->whereHas('skill',function($skill_query) use($user_skill){
							$skill_query->whereIn('skill_id',$user_skill);
						})
						->where(['is_active'=>'Yes','is_status'=>'Approved']);

		$feactured_jobs = JobPost::whereHas('category',function($category_query) use ($user_category){
							$category_query->whereIn('category_id',$user_category);
						})
						->whereIn('id',$feactured_jobs_array)
						->where(['is_active'=>'Yes','is_status'=>'Approved'])
						->union($view_more_jobs)
						->union($skill_location_array)
						->union($category_array)
						->with([
							'job_type:id,name',
							'category:id,name',
							'experience:id,name',
							'user:id,name,profile_image',
							'user_shortlist' => function($query) use ($user){
								$query->where('user_id',$user->id);
							},
							'is_featured'
						])
						->paginate(10)
						->toArray();

			foreach ($feactured_jobs['data'] as $key => $view_more_job) {

				// dd($view_more_job);

				$applied = '';
				$shortlisted = '';

				$is_feactured = 0;
				
				if($feactured_jobs['data'][$key]['is_featured'] > 0){
					if($feactured_jobs['data'][$key]['is_featured']['job_id'] == $view_more_job['id']){
						$is_feactured = 1;
					}
				}
				

				$user_job_apply = $feactured_jobs['data'][$key]['user_shortlist'];

				if ($user_job_apply != '' && $user_job_apply['is_wishlist'] == 1) {
					$shortlisted = '1';
				} elseif ($user_job_apply != '' && $user_job_apply['is_wishlist'] == '') {
					$applied = '1';
				}


				// $company_logo = '';
				if ($feactured_jobs['data'][$key]['user']['profile_image'] != NULL && $feactured_jobs['data'][$key]['user']['profile_image'] != "") {
					$company_logo =  asset('storage/profile_image/' . $feactured_jobs['data'][$key]['user']['profile_image']);
				} else {
					$company_logo = null;
				}

				$feactured_jobs['data'][$key]['job_title'] = $feactured_jobs['data'][$key]['job_title'];
				$feactured_jobs['data'][$key]['location'] = $feactured_jobs['data'][$key]['location'];
				$feactured_jobs['data'][$key]['salary'] = $feactured_jobs['data'][$key]['minimum_salary'] . '-' . $feactured_jobs['data'][$key]['maximum_salary'];
				$feactured_jobs['data'][$key]['company_name'] = $feactured_jobs['data'][$key]['user']['name'];
				$feactured_jobs['data'][$key]['experience'] = $feactured_jobs['data'][$key]['experience']['name'];
				$feactured_jobs['data'][$key]['company_logo'] = $company_logo;
				$feactured_jobs['data'][$key]['job_type'] = collect($feactured_jobs['data'][$key]['job_type'])->pluck('name')->implode(',');
				$feactured_jobs['data'][$key]['category'] = collect($feactured_jobs['data'][$key]['category'])->pluck('name')->implode(',');
				$feactured_jobs['data'][$key]['is_applied'] = $applied;
				$feactured_jobs['data'][$key]['is_shortlisted'] = $shortlisted;
				$feactured_jobs['data'][$key]['is_status'] = $feactured_jobs['data'][$key]['is_status'];
				$feactured_jobs['data'][$key]['is_feactured'] = $is_feactured;

				unset($feactured_jobs['data'][$key]['experience_id'],
				$feactured_jobs['data'][$key]['user'],
				$feactured_jobs['data'][$key]['minimum_salary'],
				$feactured_jobs['data'][$key]['maximum_salary'],
				$feactured_jobs['data'][$key]['user_id'],
				$feactured_jobs['data'][$key]['is_featured'],
				$feactured_jobs['data'][$key]['user_shortlist']);
			}

			$this->data = $feactured_jobs;
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
}
