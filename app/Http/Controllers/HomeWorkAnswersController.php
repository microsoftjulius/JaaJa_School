<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeWorkAnswers;

class HomeWorkAnswersController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }
    /**
     * This function validates the homework answers
     */
    protected function validateHomeWorkAnswers($home_work_id){
        if(empty(request()->answers_pdf)){
            return redirect()->back()->withErrors("Please attach your home work answers to make this submission");
        }else{
            $student_id = $this->authenticated_user->getLoggedInStudentsId();
            $school_id  = $this->authenticated_user->getLoggedInUserID();
            $answers_pdf = request()->answers_pdf;
            return $this->makeHomeWorkSubmission($student_id, $home_work_id, $answers_pdf, $school_id);
        }
    }

    /**
     * this function submits the homework after validation
     */
    private function makeHomeWorkSubmission($student_id, $home_work_id, $answers_pdf, $school_id){
        $new_home_work_answers = new HomeWorkAnswers;
        $new_home_work_answers->student_id  = $student_id;
        $new_home_work_answers->homework_id = $home_work_id;
        $new_home_work_answers->answer_pdf  = $answers_pdf;
        $new_home_work_answers->school_id   = $school_id;
        $new_home_work_answers->save();

        return redirect()->back()->with('msg','Your submission of homework has been recieved successfully');
    }

    /**
     * This function changes the submissions of the student provided its not past deadline
     */
    protected function changeStudentsSubmission($home_work_id){
        $answers_pdf = request()->answers_pdf;
        HomeWorkAnswers::where('id',$home_work_id)->update(array(
            'answer_pdf' => $answers_pdf
        ));
        return redirect()->back()->with('msg','Your submission of changed homework has been recieved successfully');
    }

    /**
     * The student can see all the home work sumissions they made
     */
    protected function getStudentsHomeWorkSubmissions(){
        return $this->getStudentsHomeWorkSubmissionsCollection();
    }
    /**
     * This function gets the collection of the homeworks submited by the student
     */
    private function getStudentsHomeWorkSubmissionsCollection(){
        return HomeWorkAnswers::where('student_id',$this->authenticated_user->getLoggedInStudentsId())->get();
    }

    /**
     * This function gets the homework results, the teacher who submited the homework accesses this function
     */
    protected function getAllSubmissionsForThisHomeWork($home_work_id){
        $all_results_for_this_homework = HomeWorkAnswers::where('homework_id',$home_work_id)->get();
        return $all_results_for_this_homework;
    }
}
