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
     }
     /** 
      * This function fetches all the subject from the data
     */
     protected function getSubject(){
         $subject =Subject::get();
         return response()->json([$subject,200]);
     }
     /** 
      * This function edits the subject information
     */
     protected function editSUbject($id){
         Subject::where('id',$id)->update(array(
             'subject' =>'English'
         ));
     }
     /** 
      * This function deletes subject softly
     */
     protected function deleteSubject($id){
         Subject::where('id',$id)->update(array( 'status' => 'deleted'));
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
