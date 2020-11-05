<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\level;
use DB;

class LevelController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }
    /** 
     * This function creates classes for school
    */
    private function createClass(){
        $class =new level;
        $class->class =request()->class;
        $class->school_id = $this->authenticated_user->getLoggedinTeachersId();
        $class->save();
        return Redirect()->back()->with('msg',"You have successfully created a Class");
    }
    /** 
     * This function fetches all the class from the data
    */
    protected function getClasses(){
        $class = $this->getClassesCollection();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.level', compact('class','all_users'));
    }
    /**
     * This function gets the classes collection
     */
    public function getClassesCollection(){
        return level::get();
    }
    /** 
     * This function edits the class information
    */
    protected function editClass($id){
        level::where('id',$id)->update(array(
            'class' =>request()->class_name
        ));
        return Redirect()->back()->with('msg'," Your request of updating the class name to ". request()->class_name . " has been successful");
    }
    /** 
     * This function deletes class softly
    */
    protected function deleteClass($id){
        level::where('id',$id)->delete();
        return Redirect()->back()->with('msg',"Class has been deleted successfully");
    }
    /** 
     * This function validates class function for creating class
    */
    protected function validateCraeteClass(){
        if(empty(request()->class)){
            return redirect()->back()->withErrors('Class is required, please fill it to continue');
        }elseif(level::where('class',strtolower(request()->class))->exists()){
            return redirect()->back()->withErrors('This class already exists, Please consider entering a different class');
        }else{
            return $this->createClass();
        }
    }

    /**
     * This function takes to edit form for classes
     */
    protected function editClassForm($class_id){
        $class_name = level::where('id',$class_id)->value('class');
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.edit_class',compact('class_name','class_id','all_users'));
    }
    
    /**
     * this function gets the class home works
     */
    protected function getClassHomeworks($class_id){
        $homeworks = DB::table('homework')->where('level_id',$class_id)
        ->join('subjects','subjects.id','homework.subject_id')
        ->join('teachers','teachers.id','homework.teacher_id')
        ->join('levels','levels.id','homework.level_id')
        ->get();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.class_homeworks',compact('homeworks','all_users'));
    }
}
