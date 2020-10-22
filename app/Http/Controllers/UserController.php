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
    public function createUser(){
        $user =new User();
        $user->name      =request()->name;
        $user->email     =request()->email;
        $user->password  =Hash::make($user['password']);
        $user->save();
        return Redirect()->back()->withErrors("Users Information has been created successfully");
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
    protected function deleteUser($id){
        User::where('id',$id)->update(array( 'status' => 'deleted'));
        return Redirect()->back()->withErrors("User has been deleted successfully");
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
        return User::where('role_id',1)->get();
    }
}
