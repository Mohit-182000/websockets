<?php

namespace App\Http\Controllers\api;

use DB;
use Exception;
use App\Model\KnowledgeBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class KnowledgeBankApiController extends ApiController
{
	public function getKnowledgeBank(Request $requst){
		try {

			$knowledge_bank_list = KnowledgeBank::select('id','title','media_type','file','link','description',DB::raw('DATE_FORMAT(created_at, "%e %M %Y") as date'),DB::raw('TIME_FORMAT(created_at, "%h:%i:%s %p") as time'))
												->where('is_active', 'Yes')
												->paginate(10);
			$this->data = $knowledge_bank_list;
		
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
            return $this->responseError();
		}
        return $this->responseSuccess();
	}

	public function getKnowledgeBankDetail(Request $request){
		try {

			$id = $request->id;
			$knowledge_bank_detail = KnowledgeBank::select('id','title','media_type','file','link','description')->findorfail($id);
			$this->data = $knowledge_bank_detail;
		
		} catch (Exception $e) {
			$this->response_json['message'] = $e->getMessage();
            return $this->responseError();
		}
        return $this->responseSuccess();
	}

	public function latestKnowledgeBank(Request $request){
		try {
			
			$latest_knowledge_bank = KnowledgeBank::where('is_active','Yes')->latest()->take(4)->get();
			$this->data = $latest_knowledge_bank;

		} catch (Exception $e) {

			$this->response_json['message'] = $e->getMessage();
			return $this->responseError();
		}
		return $this->responseSuccess();
	}
}
