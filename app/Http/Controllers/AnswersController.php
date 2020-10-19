<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnswersModel;

class AnswersController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }

    /**
     * This function validates the Answers for a particular question
     */
    protected function validateAnswers($question_id){
        if(empty(request()->answer_pdf)){
            return redirect()->back()->withErrors("Please attach the answer pdf to proceed");
        }elseif(AnswersModel::where('question_id',$question_id)->exists()){
            return redirect()->back()->withErrors("This question has an answer already")->withInput();
        }else{
            $this->createAnswer($question_id);
        }
    }

    /**
     * This function creates the answer for a particular question
     */
    private function createAnswer($question_id){
        $new_answer = new AnswersModel;
        $new_answer->school_id   = $this->authenticated_user->getLoggedInUserID();
        $new_answer->answer_pdf  = request()->answer_pdf;
        $new_answer->teacher_id  = $this->authenticated_user->getLoggedinTeachersId();
        $new_answer->question_id = $question_id;
        $new_answer->save();
    }

    /**
     * This fuction returns the blade that has the answers to a particular question
     */
    protected function getAnswersToQuestion($question_id){
        $answer_to_question = $this->getAnswersCollection($question_id);
        return $answer_to_question;
    }

    /**
     * This function returns the collection of the answers 
     */
    private function getAnswersCollection($question_id){
        return AnswersModel::where('question_id',$question_id)->get();
    }

    /**
     * This function updates answers to a question
     */
    protected function updateAnswersToAQuestion($question_id){
        AnswersModel::where('question_id',$question_id)->update(array(
            'answer_pdf' => request()->answer_pdf
        ));
    }

    /**
     * This function deletes the answer
     */
    protected function deleteAnswer($question_id){
        AnswersModel::where('question_id',$question_id)->delete();
    }
}