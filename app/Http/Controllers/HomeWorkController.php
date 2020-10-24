<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Homework;

class HomeWorkController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }
    /** 
     * This function creates homework for school for a particular class
    */
    private function createHomeWork(){
        $home_work =new Homework;
        $home_work ->school_id = $this->authenticated_user->getLoggedInUserID();
        $home_work->subject_id =request()->subject_id;
        $home_work->level_id =request()->level_id;
        $home_work->teacher_id =request()->teacher_id;
        $home_work->home_work =request()->home_work;
        $home_work->save();
<<<<<<< HEAD
     }
     /** 
      * This function fetches all the home work documents from the table
     */
     protected function getHomeWork(){
         $home =Homework::join('users','homework.school_id','users.id')
         ->join('levels','homework.level_id','levels.id')
         ->join('subjects','homework.subject_id','subjects.id')
         ->join('teachers','homework.teacher_id','teachers.id')
         ->get();
         return response()->json([$home,200]);
     }
     /** 
=======
        return Redirect()->back()->withErrors("You have successfully uploaded a Home work");
    }
    /** 
      * This function fetches all the home work documents from the table
     */
    protected function getHomeWork(){
        $home =Homework::join('users','homework.school_id','users.id')
        ->join('levels','homework.level_id','levels.id')
        ->join('subjects','homework.subject_id','subjects.id')
        ->join('teachers','homework.teacher_id','teachers.id')
        ->get();
        return view('admin.home-work', compact('home'));
    }
    /** 
>>>>>>> 81f91c198e1946e28732c94918b29466c5c916f2
      * This function edits the homework information
     */
    protected function editHomeWork($id){
        Homework::where('id',$id)->update(array(
<<<<<<< HEAD
             'home_work' =>'English.pdf'
         ));
        
     }
     /** 
      * This function deletes homework softly
     */
     protected function deleteHomeWork($id){
        Homework::where('id',$id)->delete();
     }
     /** 
=======
            'home_work' =>'English.pdf'
        ));
        return Redirect()->back()->withErrors("Homework has been updated successfully");
    }
    /** 
      * This function deletes homework softly
     */
    protected function deleteHomeWork($id){
    Homework::where('id',$id)->update(array( 'status' => 'deleted'));
        return Redirect()->back()->withErrors("Homework has been deleted successfully");
    }
    /** 
>>>>>>> 81f91c198e1946e28732c94918b29466c5c916f2
      * This function validates creating homework
     */
    protected function validateCreateHomeWork(){
        if(empty(request()->home_work)){
            return redirect()->back()->withErrors('Home work is required, please fill it to continue');
        }else{
            return $this->createHomeWork();
        }
    }
}
