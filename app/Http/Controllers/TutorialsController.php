<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnswersModel;

class TutorialsController extends Controller
{

    /** 
    * creating an instance of the authenticated user
    */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }

    /**
     * This function validates the tutorial
     */
    protected function validateTutorial($answer_id){
        if(empty(request()->youtube_video_url)){
            return redirect()->back()->withErrors("Please enter the youtube link for this answer, 
                the video explains how the answer is come upto");
        }else{
            return $this->createYoutubeVideo($answer_id);
        }
    }
    /**
     * This function creates the youtube video
     */
    private function createYoutubeVideo($answer_id){
        AnswersModel::where('id',$answer_id)->update(array(
            'youtube_video_url' => request()->youtube_video_url,
            'teacher_id'        => $this->authenticated_user->getLoggedinTeachersId()
        ));
    }

    /**
     * This function updates the video url
     */
    protected function updateVideoTutorial($answer_id){
        AnswersModel::where('id',$answer_id)->update(array(
            'youtube_video_url' => request()->youtube_video_url,
            'teacher_id'        => $this->authenticated_user->getLoggedinTeachersId()
        ));
    }
}
