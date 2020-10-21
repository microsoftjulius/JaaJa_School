<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    /** 
     * This function Creates Roles
    */
    protected function createRole(){
        $create_role = new Role;
        $create_role->role = request()->role;
        $create_role->save();
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
    /**
     * This function calls the soft deletes when deleting a role
     */
    protected function deleteRole($role_id){
        Role::where('id',$role_id)->delete();
    }
}
