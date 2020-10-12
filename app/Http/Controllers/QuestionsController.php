<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function __construct(){
        $this->loggedin_user_instance = new AuthenticationController; 
    }
    /**
     * This function validates the questions a user is entering 
     */
    protected function validateQuestions(){
        if(empty(request()->questions_pdf)){
            return redirect()->back()->withErrors("Please upload the questions pdf to proceed");
        }elseif(empty(request()->teacher_id)){
            return redirect()->back()->withErrors("Please select a class which you are adding this questions for to proceed");
        }
    }

    /**
     * This function gets the loggedin teachers id from the teachers table
     */
    private function getLoggedinUsersId(){
        return Teachers::where('id',$this->loggedin_user_instance->)
    }
}
