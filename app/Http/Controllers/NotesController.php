<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NotesController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }
    /** 
 * This function creates notes for school for a particular class
*/
    private function createNotes(){
        $notes =new Note;
        //$notes ->school_id = $this->authenticated_user->getLoggedInUserID();
        $notes->subject_id =request()->subject_id;
        $notes->level_id =request()->level_id;
        $notes->teacher_id =request()->teacher_id;
        $notes->notes =request()->notes;
        $notes->save();
     }
     /** 
      * This function fetches all the notes documents from the table
     */
     protected function getNotes(){
         $notes =Note::join('levels','notes.level_id','levels.id')
         ->join('subjects','notes.subject_id','subjects.id')
         ->join('teachers','notes.teacher_id','teachers.id')
         ->get();
         return response()->json([$notes,200]);
     }
     /** 
      * This function edits the notes information
     */
     protected function editNotes($id){
        Note::where('id',$id)->update(array(
             'notes' =>'English.pdf'
         ));
     }
     /** 
      * This function deletes notes permanently
     */
     protected function deletenotes($id){
        Note::where('id',$id)->delete();
     }
     /** 
      * This function validates creating notes
     */
     protected function validateCreateNotes(){
     if(empty(request()->notes)){
         return redirect()->back()->withErrors('Notes is required, please fill it to continue');
     }else{
         return $this->createNotes();
     }
     }
}
