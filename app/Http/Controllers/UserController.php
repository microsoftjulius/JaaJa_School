<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /** 
     * This function creates users 
    */
    public function createUser($names, $email, $password, $category){
        $user =new User();
        $user->name      = $names;
        $user->email     = $email;
        $user->password  = Hash::make($password);
        $user->category  = $category;
        $user->save();
    }
    /** 
     * This function validates teachers information to be submitted
    */
    protected function validateUser(){
        if(empty(request()->name)){
            return redirect()->back()->withErrors('Name is required, please fill it to continue');
        }elseif(empty(request()->email)){
            return redirect()->back()->withErrors('Email is required, please fill it to continue');
        }elseif(empty(request()->password)){
            return redirect()->back()->withErrors('Password is required, please fill it to continue');
        }else{
            return $this->createUser();
        }
    }
    /** 
     * This function retrieves all the users from users table
    */
    protected function getUsers(){
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
    protected function suspendSchool($id){
        User::where('id',$id)->update(array('status' => 'suspended'));
        return Redirect()->back()->with('msg', " You Successfully Suspended a school. None of the people that belong to this school will
            be able to login again, and for whoever has been logged in, They will be logged out automatically");
    }

    /**
     * this function activates a school that had been suspended
     */
    protected function activateSchool($school_id){
        User::where('id',$school_id)->update(array('status' => 'active'));
        return Redirect()->back()->with('msg', " You Successfully activated " . User::where('id',$school_id)->value('name'));
    }
    /**
     * This function returns the schools to the Admin
     */
    protected function getSchools(){
        $all_schools = $this->getSchoolsCollections();
        return view('admin.schools',compact('all_schools'));
    }

    /**
     * This function gets the schools, role_id 1 is for the school
     */
    private function getSchoolsCollections(){
        return User::where('category','school')->get();
    }
}
