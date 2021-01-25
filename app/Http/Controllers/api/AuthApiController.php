<?php

namespace App\Http\Controllers\api;

use Hash;
use Storage;
use App\User;
use App\Admin;
use Exception;
use App\Model\Setting;
use Illuminate\Http\Request;
use App\Exceptions\OtpNotVeriFied;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\GeneralException;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends ApiController
{
	public function signup(Request $request)
	{
		try {
			if($request->provider_id != ""){

				$userdata = User::where('provider_id', $request->provider_id)->first();

				if($userdata){

					if($userdata->user_type == $request->user_type){

						$this->user = $userdata;
						$this->data = $this->userCollection($userdata);
					}else{
						throw new Exception('Invalid Mobile Id or Password');
					}

				}else{

					if($request->profile_image){
						$data = file_get_contents($request->profile_image);

						$name = time() . '_' . rand(0, 500) . '_' .'image.jpg';
						$path = 'storage/profile_image/'.$name;

						$upload = file_put_contents($path, $data);
					}

					$admin = new User;
					$admin->name = $request->name;
					$admin->email = $request->email;
					$admin->provider = $request->provider;
					$admin->provider_id = $request->provider_id;
					$admin->profile_image = $name ?? null;
					$admin->user_type = $request->user_type;
					$admin->profile_progress = $admin->profile_progress + 30;
					$admin->is_otp_verify = '1';
					$admin->otp = null;
					$admin->is_active = 'Yes';
					$admin->save();



					// $this->data = $this->userCollection($admin)->forget('token');
					$this->data  = $this->userCollection($admin);

				}

			}else{

				$validator = Validator::make($request->all(), [
					'firstname' => 'required',
					'lastname' => 'required',
					'mobile' => 'required|digits:10|numeric|unique:users',
					'password' => 'required|same:confirm_password|min:8',
					'confirm_password' => 'required|min:8',
					'user_type' => 'required',
					// 'state_id' => 'required',
					// 'city_id' => 'required',
					// 'locality_id' => 'required',
				]);

				if ($validator->fails()) {
					throw new Exception($validator->messages()->first(), 1);
				}

				$input = $request->all();
				$otp = rand(100000, 999999);

				$admin = new User;
				$admin->name = $input['firstname'] . ' ' . $input['lastname'];
				$admin->password = Hash::make($input['password']);
				$admin->user_type = $input['user_type'];
				$admin->mobile = $input['mobile'];
				$admin->first_name = $input['firstname'];
				$admin->last_name = $input['lastname'];
				$admin->otp = $otp;
				$admin->gender = $input['gender'] ?? null;
				$admin->state_id = $input['state_id'] ?? null;
				$admin->city_id = $input['city_id'] ?? null;
				$admin->locality_id = $input['locality_id'] ?? null;
				$admin->save();

				if($request->industries != ""){
					$admin->employerIndustries()->sync($request->industries);
				}

				//meassage string for otp
				$message = "Equal App verification code " . $otp . " Please do not share your OTP or Password with anyone to avoid misuse of your account";
				$receiver_phone = $admin->mobile;
				//sned sms in mobile number
				send_sms($message, $receiver_phone);

				$this->data  = $this->userCollection($admin)->forget('token');
			}


		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();

			return $this->responseError();
		}

		return $this->responseSuccess();
	}

	public function send_otp(Request $request)
	{
		$otp = rand(100000, 999999);
		Admin::where('mobile', $request->mobile)->update(['otp' => $otp]);
		return response()->json(['message' => 'OTP Send Successfully'], 200);
	}
	public function otpsend(Request $request)
	{
		try {
			$validator = Validator::make($this->request->all(), [
				'mobile' => 'required',
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}
			$user = $this->getUserFromMobile($request->mobile);

			if (is_null($user)) {
				throw new Exception('User Not Found', 1);
			}
			// $otp = 123456; //rand(100000, 999999);
			$otp =  rand(100000, 999999);
			$user->otp = $otp;
			$user->is_otp_verify = 0;
			$user->save();


			//meassage string for otp
			$message = "Equal App verification code " . $user->otp . " Please do not share your OTP or Password with anyone to avoid misuse of your account";
			$receiver_phone = $user->mobile;
			//sned sms in mobile number
			send_sms($message, $receiver_phone);

			$this->data = $this->userCollection($user); //remove
			$this->response_json['message'] = 'Otp sent succssfully';
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
	public function resetpassword(Request $request)
	{
		try {

			$validator = Validator::make($this->request->all(), [
				'mobile' => 'required',
				'password' => 'required|min:8',
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			// User
			$user = $this->getUserFromMobile();
			$user->password = bcrypt($request->password);
			$user->save();
			$this->data = $this->userCollection($user);
			$this->response_json['message'] = 'Password changed successfully';
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
	public function forgotpassword(Request $request)
	{
		try {

			$validator = Validator::make($this->request->all(), [
				'mobile' => 'required',
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}
			$user = $this->getUserFromMobile($request->mobile);

			if (is_null($user)) {
				throw new Exception('User Not Found', 1);
			}
			$this->otpsend($request);

			$this->user = $this->getUserFromMobile($request->mobile);
			$this->data = $this->userCollection($this->user)->forget('token');
			$this->response_json['message'] = 'Otp sent successfully';
		} catch (GeneralException $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}

		return $this->responseSuccess();
	}
	public function otpVerify(Request $request)
	{
		
		try {
			$validator = Validator::make($this->request->all(), [
				'mobile' => 'required',
				'otp' => 'required',
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$user = $this->getUserFromMobile();

			if (empty($user)) {
				throw new Exception("Mobile number is not registered.", 1);
			}

			if ($user->otp != $request->otp) {
				throw new Exception("Your OTP is invalid or expired.", 2);
			}

			$user->is_otp_verify = '1';
			$user->otp = null;
			$user->is_active = 'Yes';
			$user->save();

			$this->data = $this->userCollection($user);
			$this->response_json['message'] = 'Verification successfully complete.';
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
	public function login(Request $request)
	{
		try {

			if($request->provider_id != ""){

				$userdata = User::where('provider_id', $request->provider_id)->first();

				if($userdata){

					if($userdata->user_type == $request->user_type){

						$this->user = $userdata;
						$this->data = $this->userCollection($userdata);
					}else{
						throw new Exception('Invalid Mobile Id or Password');
					}
				}else{
					if($request->profile_image){
						$data = file_get_contents($request->profile_image);

						$name = time() . '_' . rand(0, 500) . '_' .'image.jpg';
						$path = 'storage/profile_image/'.$name;

						$upload = file_put_contents($path, $data);
					}

					$admin = new User;
					$admin->name = $request->name;
					$admin->email = $request->email;
					$admin->provider = $request->provider;
					$admin->provider_id = $request->provider_id;
					$admin->profile_image = $name ?? null;
					$admin->user_type = $request->user_type;
					$admin->profile_progress = $admin->profile_progress + 30;
					$admin->is_otp_verify = '1';
					$admin->otp = null;
					$admin->is_active = 'Yes';
					$admin->save();



					// $this->data = $this->userCollection($admin)->forget('token');
					$this->data  = $this->userCollection($admin);
				}

			}else{

				$validator = Validator::make($request->all(), [
					'mobile' => 'required|digits:10|numeric',
					'password' => 'required|min:8',
					'user_type' => 'required'
				]);

				if ($validator->fails()) {
					throw new Exception($validator->messages()->first(), 1);
				}

				$userdata = User::where('mobile', $request->mobile)->first();

				if (is_null($userdata)) {
					throw new Exception('Invalid Mobile Id or Password', 1);
				}

				if ($userdata->is_active == 'No') {
					throw new GeneralException('User is not active');
				}

				if ($userdata->is_otp_verify == '0') {
					throw new OtpNotVeriFied('Otp not verifid yet');
				}
				if (!Auth::guard('user')->attempt([
					'is_active' => 'Yes',
					'mobile' => $request->mobile,
					'password' => $request->password,
					'user_type' => $request->user_type
				])) {
					throw new Exception('Invalid Mobile Id or Password', 1);
				}

				$this->user = $userdata;
				// dd($this->user);
				$tokenResult = $userdata->createToken('Personal MNS Access Token for equal app');
				$token = $tokenResult->token;
				$token->save();

				$this->data = $this->userCollection($userdata);
				$this->response_json['message'] = 'Logged In';
			}


		} catch (OtpNotVeriFied $e) {

			$this->data = $this->userCollection($userdata)->forget('token');

			$this->response_json['message'] = $e->getMessage();

			return $this->responseSuccess();
		} catch (GeneralException $e) {

			$this->response_json['message'] = $e->getMessage();

			return $this->responseError();
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();

			return $this->responseError();
		}

		return $this->responseSuccess();
	}

	public function changePassword(Request $request)
	{
		$user = $this->currentuser();
		try {
			$validator = Validator::make($request->all(), [
				'old_password' => 'required',
				'password' => 'required|same:confirm_password|min:8',
				'confirm_password' => 'required|min:8'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}
			$user = User::findorfail($user->id);
			if (Hash::check($request->old_password, $user->password)) {
				$user->password = Hash::make($request->password);
				$user->save();
			} else {
				throw new Exception('Your current password do not match in our record. Try to enter valid password', 1);
			}
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccessWithoutDataObject();
	}

	public function logout(Request $request)
	{
		$this->currentuser()->token()->revoke();
		$this->response_json['message'] = 'logged out';
		return $this->responseSuccess();
	}
	public function getProfile(Request $request)
	{
		try {
			$user = $this->currentuser();
			$user = User::with(['category:id,name', 'state:id,name', 'city:id,name', 'maritalStatus:id,name', 'user_workspace_photo:user_id,workspace_photo'])->select('id', 'name', 'email', 'first_name', 'last_name', 'mobile', 'about_company', 'address', 'website_url', 'is_otp_verify', 'is_active', 'is_complete', 'user_type', 'milestone', 'date_of_birth', 'pin_code', 'gender', 'state_id', 'city_id', 'marital_status_id', 'user_language')->findorfail($user->id);
			$this->state_name = $user->state->name ?? null;
			$user->token = $user->createToken('personal MNS Access Token for input store tools')->accessToken;
			$this->data = $user;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}

		return $this->responseSuccess();
	}
	public function updateProfile(Request $request)
	{
		try {
			$user = $this->currentuser();
			$validator = Validator::make($request->all(), [
				//'company_name' => 'required',
				//'about_company' => 'required',
				'address' => 'required',
				'email' => 'required|email|unique:users,email,' . $user->id,
				'mobile' => 'required|digits:10|numeric|unique:users,mobile,' . $user->id,
				//'profile_image' => 'required|mimes:jpg,jpeg,png'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			if ($request->hasFile('profile_image')) {
				$profile_image = $request->file('profile_image');
				$filename = time() . '_' . $profile_image->getClientOriginalName();
				$profile_image->storeAs('profile', $filename);
			}

			$user = User::findorfail($user->id);
			$user->name = $request->company_name;
			$user->about_company = $request->about_company;
			$user->address = $request->address;
			$user->state_id = $request->state_id;
			$user->city_id = $request->city_id;
			$user->pin_code = $request->pin_code;
			$user->mobile = $request->mobile;
			$user->email = $request->email;
			$user->website_url = $request->website_url;
			$user->milestone = $request->milestone;
			$user->gender = $request->gender;
			$user->marital_status_id = $request->marital_status;
			$user->date_of_birth = (isset($request->date_of_birth)) ? date('Y-m-d', strtotime($request->date_of_birth)) : '';
			$user->is_complete = 1;
			$user->save();
			$this->data = $this->userCollection($user);
		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();

			return $this->responseError();
		}

		return $this->responseSuccess();
	}

	public function generalSetting(Request $request){
		try{

			$setting = Setting::select('terms_and_condition','privacy_policy')->first();

			$toReturn = [
				'terms_and_condiiton' => strip_tags($setting->terms_and_condition),
				'privacy_policy' => strip_tags($setting->privacy_policy)
			];

			$this->data = $toReturn;
		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function salaryLimit(Request $request){
		try{

			$salary_limit = Setting::select('minimum_salary','maximum_salary')->first();

			$this->data = $salary_limit;
		}catch(Exception $e){

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
}
