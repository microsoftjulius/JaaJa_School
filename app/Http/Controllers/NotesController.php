<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\level as Classes;
use App\Subject;

class NotesController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
        $this->classes_instance   = new LevelController;
        $this->subjects_instance  = new SubjectController;
    }
    /** 
 * This function creates notes for school for a particular class
*/
    private function createNotes($class_id, $subject_id, $notes_work_path){
        $notes =new Note;
        $notes->subject_id = $subject_id;
        $notes->level_id   = $class_id;
        $notes->teacher_id = $this->authenticated_user->getLoggedinTeachersId();
        $notes->notes      = $notes_work_path;
        $notes->save();
        return Redirect()->back()->with('msg',"You have successfully added notes for ". request()->class_name);
    }
    /** 
     * This function fetches all the notes documents from the table
    */
    protected function getNotes(){
        $subjects = $this->subjects_instance->getSubjectsCollection();
        $classes  = $this->classes_instance->getClassesCollection();
        $notes = Note::join('levels','notes.level_id','levels.id')
        ->join('subjects','notes.subject_id','subjects.id')
        ->join('teachers','notes.teacher_id','teachers.id')
        ->join('users','users.id','teachers.teachers_login_id')
        ->select('notes.*','subjects.subject','levels.class','users.name')
        ->get();
        return view('admin.notes', compact('notes','subjects','classes'));
    }
    /** 
     * This function edits the notes information
    */
    protected function editNotes($id){
        Note::where('id',$id)->update(array(
            'notes' =>'English.pdf'
        ));
        return Redirect()->back()->withErrors("Notes has been updated successfully");
    }
    /** 
     * This function deletes notes softly
    */
    protected function deletenotes($id){
        Note::where('id',$id)->delete();
        return Redirect()->back()->withErrors("Notes has been deleted successfully");
    }
    /** 
     * This function validates creating notes
    */
    protected function validateCreateNotes(){
        if(empty(request()->notes)){
            return redirect()->back()->withErrors('Notes is required, please fill it to continue');
        }else{

            $class_id   = Classes::where('class',request()->class_name)->value('id');
            $subject_id = Subject::where('subject',request()->subject_name)->value('id');

            $notes_pdf = request()->notes;
            $notes_work_path = $notes_pdf->getClientOriginalName();
            $notes_pdf->move('notes/',$notes_work_path);

            return $this->createNotes($class_id, $subject_id, $notes_work_path);
        }
    }
}
