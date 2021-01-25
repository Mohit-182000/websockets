<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Chat;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Svg\Tag\Rect;

class ChatController extends Controller
{
    public function index(){
        return view('admin.chat.index');
    }

    public function user_list(Request $request){
        $user = User::WhereNotIn('id',[auth()->user()->id])
                    ->Where('user_type','!=','Admin')
                    ->get();

        return response()->json($user);
    }

    public function auth_user_data(Request $request){
        $user_data = User::findOrFail(auth()->user()->id);

        return response()->json($user_data);
    }

    public function user_chat_list(Request $request){
        $chat_list = Chat::whereIn('user_id',[$request->sender_id,$request->receiver_id])
                        ->whereIn('receiver_id',[$request->receiver_id,$request->sender_id])
                        ->get();
        
        return response()->json($chat_list); 
    }

    public function get_receiver_user(Request $request){
        $user = User::findOrFail(decrypt($request->id));
        return response()->json($user); 
    }

    public function send_messages(Request $request){
        
        $message = auth()->user()->messages()->create([
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
		]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return response()->json('success');
    }

}
