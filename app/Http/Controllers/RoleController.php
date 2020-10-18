<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    //
    /** 
     * This function Creates Roles
    */
    private function createRole(){
       $create_role =new Role;
       $create_role->role =request()->role;
    }
    /** 
     * This function retrieves Roles
    */
     protected function getRoles(){
         $get_roles =Role::get();
         return view('admin.role', compact('get_roles'));
     }
    /** 
     * This function validate role
    */
    protected function ValidateRole(){
        if(empty(request()->role)){
            return redirect()->back()->withErrors("Please Fill role to continue");
        }else{
            return $this->createRole();
        }
    }
    /** 
     * This function edits role 
    */
    /**
     * This function calls the soft deletes when deleting a role
     */
    protected function deleteRole($role_id){
        Role::where('id',$role_id)->update(array('status' =>'deleted'));
        return redirect()->back()->withErrors("Role has been deleted successfull");
    }
}
