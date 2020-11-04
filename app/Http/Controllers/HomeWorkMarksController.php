<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeWorkAnswers;
use DB;

class HomeWorkMarksController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }
    /**
     * This function takes to the page where the teacher adds student marks from
     */
    protected function addStudentMarksPage($student_id, $homework_id){
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.add_homework_marks',compact('student_id','homework_id','all_users'));
    }
    /**
     * This function updates marks for the student for a particular home work
     */
    protected function updateStudentMarks($home_work_id,$student_id){
        HomeWorkAnswers::where('homework_id',$home_work_id)->where('student_id',$student_id)->update(array(
            'marks'      => request()->marks,
            'updated_by' => $this->authenticated_user->getLoggedinTeachersId()
        ));
        return redirect()->back()->with('msg','Student Marks For HomeWork have been updated successfully');
    }
}
