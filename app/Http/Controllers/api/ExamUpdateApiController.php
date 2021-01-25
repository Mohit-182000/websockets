<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Model\ExamUpdates;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ExamUpdateApiController extends ApiController
{
	public function getExamUpdate(Request $requst)
	{
		try {
			$exam_update_list = ExamUpdates::select('id','title','no_of_post','fees','age_limit','last_date_of_exam','link','description')->where('is_active', 'Yes')->paginate(10);
			$this->data = $exam_update_list;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}

	public function getExamUpdateDetail(Request $request)
	{
		try {

			$id = $request->id;
			$exam_update_detail = ExamUpdates::select('id','title','no_of_post','fees','age_limit','last_date_of_exam','link','description')->findorfail($id);
			$this->data = $exam_update_detail;
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
}
