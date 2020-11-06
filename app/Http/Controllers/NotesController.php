<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\level as Classes;
use App\Subject;
use DB;

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
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        $notes = Note::join('levels','notes.level_id','levels.id')
        ->join('subjects','notes.subject_id','subjects.id')
        ->join('teachers','notes.teacher_id','teachers.id')
        ->join('users','users.id','teachers.teachers_login_id')
        ->select('notes.*','subjects.subject','levels.class','users.name')
        ->get();
        return view('admin.notes', compact('notes','subjects','classes','all_users'));
    }
    /** 
     * This function edits the notes information
    */
    protected function editNotes($id){
        $class_id = Classes::where('class',request()->class_name)->value('id');
        if(empty($class_id)){
            return redirect()->back()->withErrors(" Please select the class from the list");
        }
        Note::where('id',$id)->update(array(
            'level_id' => $class_id
        ));
        return redirect()->back()->with('msg'," You have changed the class for these notes to ". request()->class_name);
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

    /**
     * This function gets the edit notes form
     */
    protected function editNotesForm($notes_id){
        $class_id   = Note::where('id',$notes_id)->value('level_id');
        $class_name = Classes::where('id',$class_id)->value('class');
        $classes    = Classes::get();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.edit_notes',compact('classes','class_name','notes_id','all_users'));
    }

    /**
     * This function gets the class notes
     */
    protected function getClassNotes($class_id){
        $class_notes = Note::where('level_id',$class_id)
        ->join('subjects','subjects.id','notes.subject_id')
        ->join('teachers','teachers.id','notes.teacher_id')
        ->join('levels','levels.id','notes.level_id')
        ->get();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.class_notes',compact('class_notes','all_users'));
    }

    /**
     * This function gets the notes reports for a month
     */
    protected function getNotesReports(){
        $counts_uploaded_per_month = json_encode($this->getUploadedNotesPerMonth());
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.notes_reports',compact('counts_uploaded_per_month','all_users'));
    }
    /**
     * This function gets the notes that have been uploaded per month
     */
    private function getUploadedNotesPerMonth(){
        $months = [1,2,3,4,5,6,7,8,9,10,11,12];
        $notes_count_array = [];
        $notes_collection = Note::get();
        foreach($notes_collection as $notes){
            //go to notes and get the notes where month is in the array, save the number of notes the month has
            for($i=0; $i<count($months); $i++){
                $notes_count_in_a_month = Note::WhereMonth('created_at',$months[$i])->count();
                array_push($notes_count_array, $notes_count_in_a_month);
            }
        }
        return $notes_count_array;
    }
}
