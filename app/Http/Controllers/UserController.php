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
   private function createUser(){
    $user =new User();
    $user->name      =request()->name;
    $user->email     =request()->email;
    $user->password  =Hash::make($user['password']);
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
    protected function getUser(){
        $get_all_users =User::get();
        return response()->json([$get_all_users,200]);
    }
    /** 
     * This function edit user  details
    */
    protected function editUser($id){
        User::where('id',$id)->update(array(
            'name' =>'Ntinda primary school'
        ));
    }
    /** 
     * This function deletes users softly
    */
    protected function deleteUser($id){
        User::where('id',$id)->update(array( 'status' => 'deleted'));
    }
}
