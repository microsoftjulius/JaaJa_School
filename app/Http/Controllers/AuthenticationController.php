<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\teacher;

class AuthenticationController extends Controller
{
    /**
     * This function gets the user id of the loggedin User, for tests, we user 1
     */
    public function getLoggedInUserID(){
        return 1;
    }

    /**
     * This function gets the loggedin teachers id from the teachers table
     */
    public function getLoggedinTeachersId(){
        return 2;//Teachers::where('teachers_login_id',$this->getLoggedInUserID())->value('id');
    }
}
