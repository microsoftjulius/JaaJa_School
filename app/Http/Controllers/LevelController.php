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
    }
    /** 
     * This function fetches all the class from the data
    */
    protected function getClasses(){
        $class =level::get();
        return response()->json([$class,200]);
    }
    /** 
     * This function edits the class information
    */
    protected function editClass($id){
        level::where('id',$id)->update(array(
            'class' =>'P.7'
        ));
    }
    /** 
     * This function deletes class softly
    */
    protected function deleteClass($id){
        level::where('id',$id)->update(array( 'status' => 'deleted'));
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
