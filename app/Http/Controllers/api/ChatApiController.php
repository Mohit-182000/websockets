<?php

namespace App\Http\Controllers\api;

use App\User;
use Exception;
use App\Model\Chat;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class ChatApiController extends ApiController
{
    public function user_chat_list(Request $request){

        try{

            $validator = Validator::make($request->all(), [
				'receiver_id' => 'required|numeric',
				'user_id' => 'required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

            $chat_list = Chat::whereIn('user_id',[$request->sender_id,$request->receiver_id])
                                ->whereIn('receiver_id',[$request->receiver_id,$request->sender_id])
                                ->get();
                                
            $this->data = $chat_list;

        } catch (Exception $e){
            $this->response_json['message'] = $e->getMessage();
			return $this->responseError();
        }

        return $this->responseSuccess();
    }

    public function send_messages(Request $request){
        
        try{

            $validator = Validator::make($request->all(), [
				'receiver_id' => 'required|numeric',
				'message' => 'required'
			]);

			if ($validator->fails()) {
				throw new Exception($validator->messages()->first(), 1);
			}

			$user = $this->currentuser();

            $message = new Chat;
            $message->user_id = $user->id;
            $message->receiver_id = $request->receiver_id;
            $message->message = $request->message;
            $message->save();
    
            broadcast(new MessageSent($message->load('user')))->toOthers();

        } catch (Exception $e){
            $this->response_json['message'] = $e->getMessage();
			return $this->responseError();
        }
        return $this->responseSuccess();
    }
}
