<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Homework;
use App\level as Classes;
use App\Subject;
use DB;

class HomeWorkController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
        $this->classes_instance   = new LevelController;
        $this->subjects_instance   = new SubjectController;
    }
    /** 
     * This function creates homework for school for a particular class
    */
    private function createHomeWork($class_id, $subject_id, $home_work_path){
        $home_work = new Homework;
        $home_work->school_id  = $this->authenticated_user->getLoggedInUserID();
        $home_work->subject_id = $subject_id;
        $home_work->level_id   = $class_id;
        $home_work->teacher_id = $this->authenticated_user->getLoggedinTeachersId();
        $home_work->home_work  = $home_work_path;
        $home_work->save();
        return Redirect()->back()->with('msg',"You have added a new homework of ". request()->class_name);
    }
    /** 
      * This function fetches all the home work documents from the table
     */
    protected function getHomeWork(){
        $subjects = $this->subjects_instance->getSubjectsCollection();
        $classes  = $this->classes_instance->getClassesCollection();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        $homework = Homework::join('subjects','subjects.id','homework.subject_id')
        ->join('levels','homework.level_id','levels.id')
        ->join('teachers','homework.teacher_id','teachers.id')
        ->join('users','users.id','teachers.teachers_login_id')
        ->select('homework.*','users.name','subjects.subject','levels.class')
        ->get();
        return view('admin.home-work', compact('homework','classes','subjects','all_users'));
    }
    /** 
      * This function edits the homework information
     */
    protected function editHomeWork($id){
        $home_work_id = Subject::where('subject',strtolower(request()->subject))->value('id');
        if(empty($home_work_id)){
            return redirect()->back()->withErrors(" The subject you entered isn't registered in the system, kindly select from the list");
        }else{
            Homework::where('id',$id)->update(array(
                'subject_id' => $home_work_id
            ));
        }
        return Redirect()->back()->with('msg'," Homework has been updated successfully");
    }
    /** 
      * This function deletes homework softly
     */
    protected function deleteHomeWork($id){
        Homework::where('id',$id)->delete();
        return Redirect()->back()->with('msg',"You Deleted a home work successfully");
    }
    /** 
      * This function validates creating homework
     */
    protected function validateCreateHomeWork(){
        if(empty(request()->home_work)){
            return redirect()->back()->withErrors('Home work is required, please fill it to continue');
        }elseif(empty(request()->subject_name)){
            return redirect()->back()->withErrors('A subject is required, please fill it to continue');
        }elseif(empty(request()->class_name)){
            return redirect()->back()->withErrors('A class is required, please fill it to continue');
        }else{
            $class_id   = Classes::where('class',request()->class_name)->value('id');
            $subject_id = Subject::where('subject',request()->subject_name)->value('id');

            $home_work_pdf = request()->home_work;
            $home_work_path = $home_work_pdf->getClientOriginalName();
            $home_work_pdf->move('home_work/',$home_work_path);
    
            return $this->createHomeWork($class_id, $subject_id, $home_work_path);
        }
    }

    /**
     * This function takes to the edit home work form
     */
    protected function editHomeWorkForm($home_work_id){
        $home_work = Homework::where('homework.id',$home_work_id)
        ->join('subjects','subjects.id','homework.subject_id')
        ->join('levels','levels.id','homework.level_id')
        ->get();
        $subjects = Subject::get();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.edit_home_work',compact('home_work_id','home_work','subjects','all_users'));
    }
}
