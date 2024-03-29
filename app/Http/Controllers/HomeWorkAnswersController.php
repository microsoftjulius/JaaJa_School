<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeWorkAnswers;
use DB;

class HomeWorkAnswersController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }
    /**
     * This function returns the page on which the user is supposed to attach work from
     */
    protected function getHomeWorkAttachmentPage($home_work_id){
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.attach_homework_answers',compact('home_work_id','all_users'));
    }
    /**
     * This function validates the homework answers
     */
    protected function validateHomeWorkAnswers($home_work_id){
        if(empty(request()->answers_pdf)){
            return redirect()->back()->withErrors("Please attach your home work answers to make this submission");
        }if(HomeWorkAnswers::where('student_id',$this->authenticated_user->getLoggedInStudentsId())->where('homework_id',$home_work_id)->exists()){
            return redirect()->back()->withErrors("You can only make one submission for this home work");
        }else{
            $student_id = $this->authenticated_user->getLoggedInStudentsId();
            $school_id  = $this->authenticated_user->getLoggedInUserID();
            $answers_pdf = request()->answers_pdf;
            $answers_pdf_path = $answers_pdf->getClientOriginalName();
            $answers_pdf->move('home_work_answers/',$answers_pdf_path);
            return $this->makeHomeWorkSubmission($student_id, $home_work_id, $answers_pdf_path, $school_id);
        }
    }

    /**
     * this function submits the homework after validation
     */
    private function makeHomeWorkSubmission($student_id, $home_work_id, $answers_pdf_path, $school_id){
        $new_home_work_answers = new HomeWorkAnswers;
        $new_home_work_answers->student_id  = $student_id;
        $new_home_work_answers->homework_id = $home_work_id;
        $new_home_work_answers->answer_pdf  = $answers_pdf_path;
        $new_home_work_answers->school_id   = $school_id;
        $new_home_work_answers->save();

        return redirect()->back()->with('msg','Your submission of homework has been recieved successfully');
    }

    /**
     * This function gets the page where home work can be edited from
     */
    protected function getHomeWorkEditPage($home_work_id){
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        if(HomeWorkAnswers::where('student_id',$this->authenticated_user->getLoggedInStudentsId())->where('homework_id',$home_work_id)->exists()){
            return view('admin.edit_home_work_page',compact('home_work_id','all_users'));
        }else{
            return redirect()->back()->with("msg", "You can't make an edit to homework you haven't submited, kindly submit the home work but clickin the add homework button");
        }
    }
    /**
     * This function changes the submissions of the student provided its not past deadline
     */
    protected function changeStudentsSubmission($home_work_id){
        $answers_pdf = request()->answers_pdf;
        if(empty($answers_pdf)){
            return redirect()->back()->withErrors("Please attach the new homework you want to upload");
        }
        $answers_pdf_path = $answers_pdf->getClientOriginalName();
        $answers_pdf->move('home_work_answers/',$answers_pdf_path);
        HomeWorkAnswers::where('homework_id',$home_work_id)->where('student_id',$this->authenticated_user->getLoggedInStudentsId())
        ->update(array(
            'answer_pdf' => $answers_pdf_path
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
        $all_results_for_this_homework = HomeWorkAnswers::where('homework_id',$home_work_id)
        ->join('users','users.id','home_work_answers.student_id')->get();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.all_homework_submissions',compact('all_results_for_this_homework','all_users'));
    }
}
