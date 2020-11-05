<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PastPapersModel as PastPaper;
use DB;

class PastPapersController extends Controller
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
     * This function validates the past papers
     */
    protected function validatePastPaper(){
        if(empty(request()->class_name)){
            return redirect()->back()->withErrors("Please select a class from the list to proceed");
        }elseif(empty(request()->past_paper_pdf)){
            return redirect()->back()->withErrors("Please enter attach a past paper pdf to proceed");
        }elseif(empty(request()->subject_name)){
            return redirect()->back()->withErrors("Please select a subject from the list to proceed");
        }else{
            $class_id = DB::table('levels')->where('class',request()->class_name)->value('id');
            $subject_id = DB::table('subjects')->where('subject',request()->subject_name)->value('id');
            if(empty($class_id)){ return redirect()->back()->withErrors("Please select a class from the list to proceed, if the class isn't there, consider telling the administrator create it"); }
            if(empty($subject_id)){ return redirect()->back()->withErrors("Please select a subject from the list to proceed,  if the class isn't there, consider telling the administrator to create it"); }

            $past_paper = request()->past_paper_pdf;
            $past_paper_pdf = $past_paper->getClientOriginalName();
            $past_paper->move('past_papers/',$past_paper_pdf);

            return $this->createPastPaper($class_id, $past_paper_pdf, $subject_id);
        }
    }

    /**
     * This function creates the past papers
     */
    private function createPastPaper($class_id, $past_paper_pdf, $subject_id){
        $new_past_paper = new PastPaper;
        $new_past_paper->teacher_id     = $this->authenticated_user->getLoggedinTeachersId();
        $new_past_paper->class_id       = $class_id;
        $new_past_paper->school_id      = $this->authenticated_user->getLoggedInUserID();
        $new_past_paper->subject_id     = $subject_id;
        $new_past_paper->past_paper_pdf = $past_paper_pdf;
        $new_past_paper->year           = request()->year;
        $new_past_paper->save();
        return redirect()->back()->with('msg','You successfully added a new past paper');
    }

    /**
     * This function gets the past papers
     */
    protected function getPastPapers(){
        $subjects = $this->subjects_instance->getSubjectsCollection();
        $classes  = $this->classes_instance->getClassesCollection();
        if(auth()->user()->category == 'student'){
            $class_id = DB::table('users')->join('students','students.student_login_id','users.id')
                        ->join('levels','levels.id','students.level_id')->value('level_id');
            $past_papers = $this->getPastPapersCollectionForStudent($class_id);
        }else{
            $past_papers = $this->getPastPapersCollection();
        }
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.past_papers',compact('past_papers','classes','subjects','all_users'));
    }

    /**
     * This function gets the past papers collection
     */
    private function getPastPapersCollection(){
        return PastPaper::join('levels','levels.id','past_papers.class_id')
        ->join('subjects','subjects.id','past_papers.subject_id')
        ->join('teachers','teachers.teachers_login_id','past_papers.teacher_id')
        ->join('users','users.id','teachers.teachers_login_id')
        ->select('users.name','subjects.subject','levels.class','past_papers.*')
        ->get();
    }

    /**
     * This function gets the past papers for the student for a particular class
     */
    private function getPastPapersCollectionForStudent($class_id){
        return PastPaper::join('levels','levels.id','past_papers.class_id')
        ->join('subjects','subjects.id','past_papers.subject_id')
        ->join('teachers','teachers.teachers_login_id','past_papers.teacher_id')
        ->join('users','users.id','teachers.teachers_login_id')
        ->join('students','students.level_id','levels.id')
        ->where('levels.id',$class_id)
        ->select('users.name','subjects.subject','levels.class','past_papers.*')
        ->get();
    }

    /**
     * This function updates the past papers
     */
    protected function updatePastPaper($past_paper_id){
        $class_id = DB::table('levels')->where('class',request()->class_name)->value('id');
        $subject_id = DB::table('subjects')->where('subject',request()->subject_name)->value('id');

        if(empty($class_id)){ return redirect()->back()->withErrors("A Class is required");}
        if(empty($subject_id)){ return redirect()->back()->withErrors("A Subject is required");}
        if(empty(request()->year)){ return redirect()->back()->withErrors("A Year is required");}

        PastPaper::where('id',$past_paper_id)->update(array(
            'class_id'   => $class_id,
            'subject_id' => $subject_id,
            'year'       => request()->year
        ));
        return redirect()->back()->with('msg',' your request to update a past paper class was successful');
    }

    /**
     * This function deletes the past paper
     */
    protected function deletePastPaper($past_paper_id){
        PastPaper::find($past_paper_id)->delete();
        return redirect()->back()->with('msg','Your request to delete a past paper was successful');
    }

    /**
     * This function displays the edit past papers form
     */
    protected function editPastPapersForm($past_paper_id){
        $subjects = $this->subjects_instance->getSubjectsCollection();
        $classes  = $this->classes_instance->getClassesCollection();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        $year = PastPaper::where('id',$past_paper_id)->value('year');
        $subject = PastPaper::join('subjects','subjects.id','past_papers.subject_id')->where('past_papers.id',$past_paper_id)->value('subject');
        $class_name = PastPaper::join('levels','levels.id','past_papers.class_id')->where('past_papers.id',$past_paper_id)->value('class');
        return view('admin.edit_past_papers_form',compact('past_paper_id','all_users','subjects','classes','year','subject','class_name'));
    }

    /**
     * This function gets the past papers of a selected class
     */
    protected function getClassPastPapers($class_id){
        $class_past_papers = PastPaper::where('class_id',$class_id)
        ->join('subjects','subjects.id','past_papers.subject_id')
        ->join('teachers','teachers.id','past_papers.teacher_id')
        ->join('levels','levels.id','past_papers.class_id')
        ->get();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        return view('admin.class_past_papers',compact('class_past_papers','all_users'));
    }
}
