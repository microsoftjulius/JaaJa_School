<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\Subject;
use App\level as Classes;

class QuestionsController extends Controller
{
    /**
     * This function creates an instance of an authenticated user
     */
    public function __construct(){
        $this->loggedin_user_instance = new AuthenticationController; 
        $this->classes_instance       = new LevelController;
        $this->subjects_instance      = new SubjectController;
    }

    /**
     * This function validates the questions a user is entering 
     */
    protected function validateQuestions(){
        if(empty(request()->questions_pdf)){
            return redirect()->back()->withErrors("Please upload the questions pdf to proceed");
        }else{
            $class_id   = Classes::where('class',request()->class_name)->value('id');
            $subject_id = Subject::where('subject',request()->subject_name)->value('id');

            $questions_pdf = request()->questions_pdf;
            $questions_path = $questions_pdf->getClientOriginalName();
            $questions_pdf->move('questions/',$questions_path);
            return $this->saveQuestion($class_id, $subject_id, $questions_path);
        }
    }

    /**
     * This function saves the questions
     */
    private function saveQuestion($class_id, $subject_id, $questions_path){
        $new_question = new Questions;
        $new_question->class_id       = $class_id;
        $new_question->school_id      = $this->loggedin_user_instance->getLoggedInUserID();
        $new_question->questions_pdf  = $questions_path;
        $new_question->teacher_id     = $this->loggedin_user_instance->getLoggedinTeachersId();
        $new_question->subject_id     = $subject_id;
        $new_question->save();
        return redirect()->back()->with('msg','You have successfully added questions for '. request()->class_name);
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
        $all_questions = $this->getQuestions();
        $subjects = $this->subjects_instance->getSubjectsCollection();
        $classes  = $this->classes_instance->getClassesCollection();
        return view('admin.all_questions',compact('all_questions','subjects','classes'));
    }

    /**
     * This function gets all the questions, questions are returned to every student independent
     * of the school
     */
    private function getQuestions(){
        $all_questions = Questions::join('levels','levels.id','questions.class_id')
        ->join('teachers','teachers.id','questions.teacher_id')
        ->join('users','users.id','teachers.teachers_login_id')
        ->select('questions.*','users.name','levels.class')
        ->get();
        return $all_questions;
    }

    /**
     * This function deletes the question
     */
    protected function deleteQuestion($questions_id){
        Questions::find($questions_id)->delete();
        return redirect()->back()->with('msg',"A Question has been deleted successfully");
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
