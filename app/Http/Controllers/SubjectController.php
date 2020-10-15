<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

class SubjectController extends Controller
{
     /** 
     * This function creates subject for school
    */
    private function createSubject(){
        $subject =new Subject;
        $subject->subject =request()->subject;
        $subject->save();
        return Redirect()->back()->withErrors("You have successfully created a Subjct");
     }
     /** 
      * This function fetches all the subject from the data
     */
     protected function getSubject(){
         $subject =Subject::get();
         return view('admin.subject', compact('subject'));
     }
     /** 
      * This function edits the subject information
     */
     protected function editSUbject($id){
         Subject::where('id',$id)->update(array(
             'subject' =>'English'
         ));
         return Redirect()->back()->withErrors("Subject has been updated successfully");
     }
     /** 
      * This function deletes subject softly
     */
     protected function deleteSubject($id){
         Subject::where('id',$id)->update(array( 'status' => 'deleted'));
         return Redirect()->back()->withErrors("Subject has been deleted successfully");
     }
     /** 
      * This function validates creating subject
     */
     protected function validateCreateSubject(){
     if(empty(request()->subject)){
         return redirect()->back()->withErrors('Subject is required, please fill it to continue');
     }else{
         return $this->createSubject();
     }
     }
}
