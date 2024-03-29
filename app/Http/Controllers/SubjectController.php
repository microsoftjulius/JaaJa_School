<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use DB;

class SubjectController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }
    /** 
     * This function creates subject for school
    */
    private function createSubject(){
        $subject =new Subject;
        $subject->subject = strtolower(request()->subject);
        $subject->school_id = $this->authenticated_user->getLoggedinTeachersId();
        $subject->save();
        return Redirect()->back()->with('msg',"You successfully added a new Subject");
    }
    /** 
      * This function fetches all the subject from the data
     */
    protected function getSubjects(){
        $subject = $this->getSubjectsCollection();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.subject', compact('subject','all_users'));
    }

    /**
     * This function gets the Subjects collection
     */
    public function getSubjectsCollection(){
        return Subject::get();
    }
    /** 
      * This function edits the subject information
     */
    protected function editSUbject($id){
        Subject::where('id',$id)->update(array(
            'subject' => strtolower(request()->subject)
        ));
        return Redirect()->back()->with('msg',"Subject has been updated successfully");
    }
    /** 
      * This function deletes subject softly
     */
    protected function deleteSubject($id){
        Subject::where('id',$id)->delete();
        return Redirect()->back()->with('msg',"Subject has been deleted successfully");
    }
    /** 
      * This function validates creating subject
     */
    protected function validateCreateSubject(){
        if(empty(request()->subject)){
            return redirect()->back()->withErrors('Subject is required, please fill it to continue');
        }elseif(Subject::where('subject',strtolower(request()->subject))->exists()){
            return redirect()->back()->withErrors("This subject already exists, please enter a new subject to proceed")->withInput();
        }
        else{
            return $this->createSubject();
        }
    }

    /**
     * This function returns the form for edit subject
     */
    protected function editSubjectForm($subject_id){
        $subject_name = Subject::where('id',$subject_id)->value('subject');
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.edit_subject',compact('subject_id','subject_name','all_users'));
    }
}
