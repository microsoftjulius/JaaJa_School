<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;

class QuestionsController extends Controller
{
    /**
     * This function creates an instance of an authenticated user
     */
    public function __construct(){
        $this->loggedin_user_instance = new AuthenticationController; 
    }

    /**
     * This function validates the questions a user is entering 
     */
    protected function validateQuestions(){
        if(empty(request()->questions_pdf)){
            return redirect()->back()->withErrors("Please upload the questions pdf to proceed");
        }else{
            return $this->saveQuestion();
        }
    }

    /**
     * This function saves the questions
     */
    private function saveQuestion(){
        $new_question = new Questions;
        $new_question->class_id       = request()->class_id;
        $new_question->school_id      = $this->loggedin_user_instance->getLoggedInUserID();
        $new_question->questions_pdf  = request()->questions_pdf;
        $new_question->teacher_id     = $this->loggedin_user_instance->getLoggedinTeachersId();
        $new_question->save();
    }

    /**
     * This function edits the Questions
     */
    protected function editQuestions($questions_id){
        Questions::where('id',$questions_id)->update(array(
            'questions_pdf' => request()->questions_pdf,
            'class_id'      => request()->class_id
        ));
    }

    /**
     * This function returns the questions blade
     */
    protected function getAllQuestions(){
        return $this->getQuestions();
    }

    /**
     * This function gets all the questions, questions are returned to every student independent
     * of the school
     */
    private function getQuestions(){
        $all_questions = Questions::get();
        return $all_questions;
    }

    /**
     * This function deletes the question
     */
    protected function deleteQuestion($questions_id){
        Questions::find($questions_id)->delete();
    }

    /**
     * This function returns the view for viewing questions of a particular school
     */
    protected function getSchoolQuestions(){
        $school_questions = $this->getSchoolQuestionsCollection();
        return $school_questions;
    }

    /**
     * This function returns the collection of a particular school
     */
    private function getSchoolQuestionsCollection(){
        return Questions::where('school_id',$this->loggedin_user_instance->getLoggedInUserID())->get();
    }
}
