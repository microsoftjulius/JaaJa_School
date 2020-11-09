<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\teacher;
use App\User;
use DB;

class TeachersController extends Controller
{
    /** 
     * creating an instance of the authenticated user
    */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
        $this->user_instance      = new UserController;
    }
    /** 
     * This function fetches all the teachers from both users and teacher table
    */
    protected function getTeachers(){
        $all_users = User::where('id','!=',auth()->user()->id)->get();
        $get_all_teachers = teacher::join('users','teachers.teachers_login_id','users.id')
        ->join('roles','roles.id','users.role_id')
        ->select('teachers.photo','teachers.teachers_login_id','teachers.teachers_name',
            'teachers.contact','teachers.status','users.name','roles.role')
        ->get();
        $roles = DB::table('roles')->get();
        return view('admin.teacher', compact('get_all_teachers','all_users','roles'));
    }
    /** 
     * This function creates teacher details 
     * It saves both to users table and teachers Table
    */
    private function submitTeacher($teachers_photo, $role_id){
        if(User::where('email',request()->contact)->exists()){
            return redirect()->back()->withErrors("An Account having this contact already exists, Please consider using a new contact");
        }
        $this->user_instance->createUser(request()->teachers_name, 
                        request()->contact, request()->contact, 'teacher', $role_id);
        //getting the teachers Id from the users table
        $teachers_login_id = User::where('email',request()->contact)->value('id');

        $create_teacher_to_teacher_table =new teacher;
        $create_teacher_to_teacher_table ->school_id         = $this->authenticated_user->getLoggedInUserID();
        $create_teacher_to_teacher_table->teachers_login_id  = $teachers_login_id;
        $create_teacher_to_teacher_table->photo              = $teachers_photo;
        $create_teacher_to_teacher_table->teachers_name      = request()->teachers_name;
        $create_teacher_to_teacher_table->contact            = request()->contact;
        $create_teacher_to_teacher_table->save();
        return Redirect()->back()->with('msg'," A new teacher has been created successfully");
    }
    /** 
     * This function edits the teacher information
    */
    protected function editTeacher($id){
        User::where('id',$id)->update(array(
            'name' =>'Ociba Flaviuos'
        ));
        return Redirect()->back()->withErrors("Teacher Information has been updated successfully");
    }
    /** 
     * This function validates teachers information to be submitted
    */
    protected function validateSubmitTeacher(){
        if(empty(request()->photo)){
            return redirect()->back()->withErrors('Photo is required, please fill it to continue');
        }elseif(empty(request()->teachers_name)){
            return redirect()->back()->withErrors('teachers is required, please fill it to continue');
        }elseif(empty(request()->contact)){
            return redirect()->back()->withErrors('Contact is required, please fill it to continue');
        }elseif(empty(request()->role)){
            return redirect()->back()->withErrors("Please select a role to assign to this teacher")->withInput();
        }elseif(DB::table('roles')->where('role',request()->role)->exists()){
            $save_teachers_image = request()->photo;
            $teachers_photo = $save_teachers_image->getClientOriginalName();
            $save_teachers_image->move('teachers-photos/',$teachers_photo);
            $role_id = DB::table('roles')->where('role',request()->role)->value('id');

            return $this->submitTeacher($teachers_photo, $role_id);
        }else{
            return redirect()->back()->withErrors("Please select a role from the list, In order to create a new role, go to settings")->withInput();
        }
    }
    /** 
     * This function suspends a teacher
    */
    protected function suspendTeacher($id){
        User::where('id',$id)->update(array('status'=>'suspended'));
        teacher::where('teachers_login_id',$id)->update(array('status'=>'suspended'));
        return Redirect()->back()->with('msg',"Teacher has been suspended successfully");
    }

    /** 
     * This function activates a teachers
    */
    protected function activateTeacher($id){
        User::where('id',$id)->update(array('status'=>'active'));
        teacher::where('teachers_login_id',$id)->update(array('status'=>'active'));
        return Redirect()->back()->with('msg',"Teacher has been activates successfully");
    }
}
