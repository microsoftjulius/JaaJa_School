<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\teacher;
use App\User;

class AuthenticationController extends Controller
{
    /**
     * This function gets the user id of the loggedin User, for tests, we user 1
     * this is the school ID
     */
    public function getLoggedInUserID(){
        return auth()->user()->id; //Auth::user()->id
    }

    /**
     * This function gets the loggedin teachers id from the teachers table
     */
    public function getLoggedinTeachersId(){
        return auth()->user()->id;
    }

    /**
     * This function gets the LoggedInStidents ID
     */
    public function getLoggedInStudentsId(){
        return auth()->user()->id; //Students::where('students_login_id',$this->getLoggedInUserID())->value('id);
    }
}
