<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use DB;
use App\User;
use App\PermissionRoles;

class RoleController extends Controller
{
    /** 
     * This function Creates Roles
    */
    protected function createRole(){
        $create_role = new Role;
        $create_role->role = strtolower(request()->role);
        $create_role->save();
        return redirect()->back()->with('msg','your request to create a new role was successful');
    }
    /** 
     * This function validate role
    */
    protected function validateRole(){
        if(empty(request()->role)){
            return redirect()->back()->withErrors("Please Fill role to continue");
        }elseif(Role::where('role',strtolower(request()->role))->exists()){
            return redirect()->back()->withErrors("This role already exists, consider creating a new role");
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

    /**
     * This function assigns the roles to a permission
     */
    protected function assignPermissionsToRole(){
        if(empty(request()->permission)){
            return redirect()->back()->withErrors("You didn't select any permission, please select a permission to proceed");
        }elseif(empty(request()->role_id)){
            return redirect()->back()->withErrors("You didn't select any role, please select a role to proceed");
        }

        for($i = 0; $i<count(request()->permission); $i++){
        //check if this role already has this permision, if so, skip it
            if(DB::table('permission_roles')->where('role_id',request()->role_id)
                ->where('permission_id',request()->permission[$i])->exists()){
                    continue;
            }else{
                $new_permission = new PermissionRoles;
                $new_permission->role_id = request()->role_id;
                $new_permission->permission_id = request()->permission[$i];
                $new_permission->created_by = auth()->user()->id;
                $new_permission->save();
            }
        }
        $role_name = Role::where('id',request()->role_id)->value('role');
        return redirect()->back()->with('msg',"Your successfully added ". count(request()->permission) . " permissions to ". $role_name);
    }

    /**
     * This function gets the assign roles page
     */
    protected function getAssignRolesPage(){
        $get_roles =Role::get();
        $all_users = DB::table('users')->join('roles','roles.id','users.role_id')
        ->select('roles.role','users.*')
        ->get();
        return view('admin.assign_roles_page',compact('all_users','get_roles'));
    }

    protected function AssignRoleToUser(){
        if(empty(request()->users)){
            return redirect()->back()->withErrors('Please select atleast one user to proceed');
        }elseif(empty(request()->role_id)){
            return redirect()->back()->withErrors("Please select a role to assign to the user(s)");
        }
        for($i=0; $i<count(request()->users); $i++){
            User::where('id',request()->users[$i])->update(array(
                'role_id' => request()->role_id
            ));
        }

        return redirect()->back()->with('msg',"Your request of assigning the roles to the selected users was successful");
    }
}
