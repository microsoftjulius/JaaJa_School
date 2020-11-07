<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SettingsController extends Controller
{

    /**
     * This function creates an instance of an authenticated user
     */
    public function __construct(){
        $this->loggedin_user_instance = new AuthenticationController; 
    }
    protected function getSettingsPage(){
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        $user_permissions = $this->getPermissions();
        $user_roles = $this->getRoles();
        return view('admin.settings_page',compact('all_users','user_permissions','user_roles'));
    }

    /**
     * This function gets the permissions
     */
    private function getPermissions(){
        return DB::table('permissions')->get();
    }

    /**
     * This function gets the roles
     */
    private function getRoles(){
        return DB::table('roles')->get();
    }
}
