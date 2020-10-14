<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
   
    /** 
     * This function retrieves all the users from users table
    */
    protected function getUser(){
        $get_all_users =User::get();
        return view('admin.all-users',compact('get_all_users'));
    }
    /** 
     * This function edit user  details
    */
    protected function editUser($id){
        User::where('id',$id)->update(array(
            'name' =>'Ntinda primary school'
        ));
        return Redirect()->back()->withErrors("Users was has been updated successfully");
    }
    /** 
     * This function deletes users softly
    */
    protected function deleteUser($id){
        User::where('id',$id)->update(array( 'status' => 'deleted'));
        return Redirect()->back()->withErrors("User has been deleted successfully");
    }
}
