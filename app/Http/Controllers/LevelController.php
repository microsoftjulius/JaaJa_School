<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\level;

class LevelController extends Controller
{
    /** 
     * This function creates classes for school
    */
    private function createClass(){
        $class =new level;
        $class->class =request()->class;
        $class->save();
        return Redirect()->back()->withErrors("You have successfully created a Class");
    }
    /** 
     * This function fetches all the class from the data
    */
    protected function getClasses(){
        $class =level::get();
        return view('admin.level', compact('class'));
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
        level::where('id',$id)->update(array( 'status' => 'deleted'));
        return Redirect()->back()->withErrors("Class has been deleted successfully");
    }
    /** 
     * This function validates class function for creating class
    */
    protected function validateCraeteClass(){
    if(empty(request()->class)){
        return redirect()->back()->withErrors('Class is required, please fill it to continue');
    }else{
        return $this->createClass();
    }
    }
}
