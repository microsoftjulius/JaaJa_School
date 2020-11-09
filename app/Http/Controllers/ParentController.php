<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParentInformation;
use App\User;
use DB;

class ParentController extends Controller
{
    /** 
     * creating an instance of the authenticated user
    */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
        $this->user_instance      = new UserController;
    }

    /** 
     * This function creates parents information
    */
    private function createParent($photo_path, $role_id){
        if(User::where('email',request()->contact)->exists()){
            return redirect()->back()->withErrors("An Account having this contact already exists, Please consider using a new contact");
        }
        //creating a parent with user name and password as contact
        $this->user_instance->createUser(request()->parent_name, request()->contact, request()->contact, 'parent', $role_id);
        //getting the parents Id from the users table
        $parent_login_id = User::where('email',request()->contact)->value('id');
        //creating a parent
        $parent_information = new ParentInformation;
        $parent_information->parent_name      = request()->parent_name;
        $parent_information->contact          = request()->contact;
        $parent_information->location         = request()->location;
        $parent_information->created_by       = $this->authenticated_user->getLoggedInUserID();
        $parent_information->photo            = $photo_path;
        $parent_information->parents_login_id = $parent_login_id;
        $parent_information->save();
        return Redirect()->back()->with('msg',"Parent Information has been saved successfully, the parent can now login with the contact as the username and password");
    }
    /** 
     * This function fetches all the parents details
    */
    protected function getParents(){
        $parent_information = $this->getParentsCollection();
        $all_users = DB::table('users')->where('id','!=',auth()->user()->id)->get();
        $roles = DB::table('roles')->get();
        return view('admin.parent', compact('parent_information','all_users','roles'));
    }

    /**
     * This function gets the parents collection
     */
    public function getParentsCollection(){
        return ParentInformation::join('users','users.id','parent_information.parents_login_id')
        ->join('roles','roles.id','users.role_id')
        ->get();
    }
    /** 
     * This function edits the student information
    */
    protected function editParentInformation($id){
        ParentInformation::where('id',$id)->update(array(
            'parent_name' =>'Ociba James',
            'contact'     =>'0775401793',
            'location'    =>'Nsambya'
        ));
        return Redirect()->back()->withErrors("Parent Information has been updated successfully");
    }
    /** 
     * This function deletes parents information softly
    */
    protected function suspendParent($id){
        $parent_login_id = ParentInformation::where('id',$id)->value('parents_login_id');
        User::where('id',$parent_login_id)->update(array('status'=>'suspended'));
        ParentInformation::where('id',$id)->update(array(
            'status' => 'inactive'
        ));
        return Redirect()->back()->with('msg',"Parent has been suspended successfully");
    }
    /** 
     * This function validates the parents information created
    */
    protected function validateCreateParent(){
        if(empty(request()->parent_name)){
            return redirect()->back()->withErrors('Parent Name is required, please fill it to continue')->withInput();
        }elseif(empty(request()->contact)){
            return redirect()->back()->withErrors('Contact is required, please fill it to continue')->withInput();
        }elseif(empty(request()->location)){
            return redirect()->back()->withErrors('Location is required, please fill it to continue')->withInput();
        }elseif(empty(request()->role)){
            return redirect()->back()->withErrors("Please select a role to assign to this parent")->withInput();
        }elseif(DB::table('roles')->where('role',request()->role)->exists()){
            $role_id = DB::table('roles')->where('role',request()->role)->value('id');
            $parent_photo = request()->photo;
            $photo_path = $parent_photo->getClientOriginalName();
            $parent_photo->move('parent_photo/',$photo_path);
            return $this->createParent($photo_path, $role_id);
        }else{
            return redirect()->back()->withErrors("Please select a role from the list, In order to create a new role, go to settings")->withInput();
        }
    }
    /**
     * This function edits the parents form
     */
    protected function editParentForm($parent_id){
        $all_users = User::where('id','!=',auth()->user()->id)->get();
        return view('admin.edit_parent_form',compact('parent_id','all_users'));
    }

    /**
     * This function activates the parent
     */
    protected function activateParent($id){
        $parent_login_id = ParentInformation::where('id',$id)->value('parents_login_id');
        User::where('id',$parent_login_id)->update(array('status'=>'active'));
        ParentInformation::where('id',$id)->update(array(
            'status' => 'active'
        ));
        return Redirect()->back()->with('msg',"A parent has been activated successfully");
    }
}
