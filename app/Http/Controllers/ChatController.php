<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chating;

class ChatController extends Controller
{
    /**
     * This function returns the blade where the users chat from
     */
    protected function chatWithSpecificUser($user_id){
        $user_name = User::where('id',$user_id)->value('name');
        $all_users = User::where('id','!=',auth()->user()->id)->get();
        $chat_with_teacher = $this->getSentMessagesAndRecievedForSpecificTeacher($user_id);
        return view('admin.chating_blade',compact('all_users','user_name','chat_with_teacher'));
    }

    /**
     * This function gets the sent and recieved messages for the loggein user
     */
    private function getSentAndRecievedMessages(){
        // return Chating::where('sender_id',auth()->user()->id)->orWhere('reciever_id',);
    }

    /**
     * This function gets the messages sent to a teacher
     */
    private function getSentMessagesAndRecievedForSpecificTeacher($user_id){
        $get_all_chats = Chating::get();
        $chats_array = [];
        foreach($get_all_chats as $chats){
            if($chats->sender_id == $user_id || $chats->reciever_id == $user_id){
                array_push($chats_array, $chats);
            }
        }
        return $chats_array;
    }

    /**
     * This function validates the chat
     */
    protected function validateChat($user_id){
        if(empty(request()->comment)){
            return redirect()->back()->withErrors("Please enter the comment to proceed");
        }else{
            return $this->makePrivateDiscussion($user_id);
        }
    }

    /**
     * This function saves the private discussion
     */
    private function makePrivateDiscussion($user_id){
        $new_comment = new Chating;
        $new_comment->sender_id = auth()->user()->id;
        $new_comment->reciever_id = $user_id;
        $new_comment->message = request()->comment;
        $new_comment->save();
        return redirect()->back()->with('msg','Your message was sent successfuly');
    }
}
