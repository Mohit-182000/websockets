<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public $successStatus = 200;
    public $response_json = [];
    protected $data = [];
    protected $request;

    public function __construct(Request $request)
    {

        Log::channel('api')->info($request->all());
        $this->request = $request;
        $this->response_json['message'] = 'Success';
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess()
    {
        $this->response_json['data'] = (object) $this->data;
        $this->response_json['status'] = 1;
        return response()->json($this->response_json, 200);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccessWithoutDataObject()
    {
        $this->response_json['status'] = 1;
        return response()->json($this->response_json, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError()
    {
        $this->response_json['data'] = (object)  $this->data;
        $this->response_json['status'] = 0;
        return response()->json($this->response_json, 200);
    }


    public function currentuser()
    {
        return Auth::guard('api')->check() ? Auth::guard('api')->user() : false;
    }

    public function getUserFromMobile($mobile = null)
    {
        return User::where('mobile', $mobile ?? request('mobile'))
            ->first();
    }

    public function userCollection($user)
    {   
        
        $is_payment = 0;
        $payment_date = null;

        if($user->user_type == 'JOBSEEKER'){
            if($user->is_featured()->exists()){
                $is_payment = 1;
                $payment_date = $user->is_featured->created_at;
            }
        }

        return collect([
            'id' => $user->id,
            'user_type' => $user->user_type,
            'name' => $user->name ?? null,
            'first_name' => $user->first_name ?? null,
            'last_name' => $user->last_name ?? null,
            'email' => $user->email ?? null,
            'company_name' => $user->company_name ?? null,
            'website_url' => $user->website_url ?? null,
            'email' => $user->email ?? null,
            'mobile' => $user->mobile,
            'profile_progress' => $user->profile_progress,
            'is_profile_complete' => ($user->profile_progress > 60) ? 1 : 0,
            'user_language' => $user->user_language ?? null,
            'profile_image' => $user->employer_profile_image ?? null,
            'is_active' => $user->is_active,
            'token' => $user->createToken('personal MNS Access Token for input store tools')->accessToken,
            'is_otp_verify' => (int) $user->is_otp_verify,
            'is_complete' => $user->is_complete,
            'otp' => $user->otp,
            'category' => $user->category,
            'employer_preferences' => $user->interests ?? null,
            'is_social_media' => ($user->provider_id != null) ? 1 : 0,
            'is_payment' => $is_payment,
            'remaining_days' => date_difference($payment_date)
            // 'image' => $user->profile_image
        ]);
    }
}
