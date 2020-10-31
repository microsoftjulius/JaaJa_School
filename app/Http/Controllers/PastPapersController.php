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
    }
    /**
     * This function validates the past papers
     */
    protected function validatePastPaper(){
        if(empty(request()->class_name)){
            return redirect()->back()->withErrors("Please select a class from the list to proceed");
        }elseif(empty(request()->past_paper_pdf)){
            return redirect()->back()->withErrors("Please enter attach a past paper pdf to proceed");
        }else{
            $class_id = 1; // DB::table('levels')->where('class',request()->class_name)->value('id');
            $past_paper_pdf = request()->past_paper_pdf;
            return $this->createPastPaper($class_id, $past_paper_pdf);
        }
    }

    /**
     * This function creates the past papers
     */
    private function createPastPaper($class_id, $past_paper_pdf){
        $new_past_paper = new PastPaper;
        $new_past_paper->teacher_id = $this->authenticated_user->getLoggedinTeachersId();
        $new_past_paper->class_id   = $class_id;
        $new_past_paper->school_id  = $this->authenticated_user->getLoggedInUserID();
        $new_past_paper->past_paper_pdf = $past_paper_pdf;
        $new_past_paper->save();
        return redirect()->back()->with('msg','You successfully added a new past paper');
    }

    /**
     * This function gets the past papers
     */
    protected function getPastPapers(){
        $past_papers = $this->getPastPapersCollection();
        return $past_papers;
    }

    /**
     * This function gets the past papers collection
     */
    private function getPastPapersCollection(){
        return PastPaper::get();
    }

    /**
     * This function updates the past papers
     */
    protected function updatePastPaper($past_paper_id){
        $class_id = 1; // DB::table('levels')->where('class',request()->class_name)->value('id');
        PastPaper::where('id',$past_paper_id)->update(array(
            'class_id' => 2
        ));
        return redirect()->back()->with('msg',' your request to update a past paper class was successful');
    }

    /**
     * This function deletes the past paper
     */
    protected function deletePastPaper($past_paper_id){
        PastPaper::find($past_paper_id)->delete();
        return redirect()->back()->with('msg','Your request to delete a past paper was successfuly');
    }
}
