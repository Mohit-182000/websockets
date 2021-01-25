<?php

namespace App\Http\Controllers\api;

use DB;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Model\Package;
use App\Model\Payment;

class PaymentApiController extends ApiController
{
    public function getPackageDetail(Request $request){
        try {

            $user = $this->currentuser();

            $package = Package::when(($user->user_type == "EMPLOYER"),function($employer_query){
                                    $employer_query->where('package_user_type','EMPLOYER');
                                },function($jobseeker_query){
                                    $jobseeker_query->where('package_user_type','JOBSEEKER');
                                })
                                ->select('name','price','validity','description')
                                ->first();

            $this->data = $package;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
            return $this->responseError();
		}
        return $this->responseSuccess();
    }

    public function storePayment(Request $request){
        try{

            $user = $this->currentuser();
            
            $payment_array = json_decode($request->detail);

            $add = new Payment();
            $add->job_id = $request->job_id;
            $add->package_id = $request->package_id;
            $add->user_id = $user->id;
            $add->mihpayid = $payment_array->result->mihpayid;  
            $add->payment_id = $payment_array->result->paymentId;
            $add->status = $payment_array->result->status;
            $add->detail = $request->detail;
            $add->is_from = $request->is_from;
            $add->user_type = $request->user_type;
            $add->is_active = 'Yes';
            $add->save();

            $this->data = $this->userCollection($user);

        }catch(Exception $e){
            $this->response_json['message'] = $e->getMessage();
            return $this->responseError();
        }
        return $this->responseSuccess();
    }
}
