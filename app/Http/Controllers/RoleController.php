<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    /** 
     * This function Creates Roles
    */
    private function createRole(){
       $create_role =new Role;
       $create_role->role =request()->role;
       $save_student_to_user_table->email     =request()->email;
       $create_role->save();
    }
    /** 
     * This function retrieves Roles
    */
     protected function getRoles(){
         $get_roles =Role::get();
         return response()->json([$get_roles,200]);
     }
    /** 
     * This function validate role
    */
    protected function validateRole(){
        if(empty(request()->role)){
            return redirect()->back()->withErrors("Please Fill role to continue");
        }else{
            return $this->createRole();
        }
    }
    /** 
     * This function edits role 
    */
    protected function editRole($id){
        Role::where('id',$id)->update(array(
            'role' =>'student'
        ));
    }
    /**
     * This function calls the soft deletes when deleting a role
     */
    protected function deleteRole($id){
        Role::where('id',$id)->update(array('status' =>'deleted'));
    }
}
