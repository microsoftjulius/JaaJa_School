<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\level;

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
        return view('admin.level', compact('class'));
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
            'class' =>'P.7'
        ));
        return Redirect()->back()->withErrors("Class has been updated successfully");
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
}
