<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\teacher;
use App\User;

class TeachersController extends Controller
{
    /** 
     * creating an instance of the authenticated user
    */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }
    /** 
     * This function fetches all the teachers from both users and teacher table
    */
    protected function getTeachers(){
        $get_all_teachers =teacher::join('users','teachers.school_id','users.id')
        ->join('levels','teachers.level_id','levels.id')
        ->join('subjects','teachers.subject_id','subjects.id')
        ->where('users.id',$this->authenticated_user->getLoggedInUserID())
        ->get();
        return view('admin.teacher', compact('get_all_teachers'));
    }
    /** 
     * This function creates teacher details 
     * It saves both to users table and teachers Table
    */
    private function submitTeacher(){
        // $save_teachers_image = request()->photo;
        // $original_name = $save_teachers_image->getClientOriginalName();
        // $save_teachers_image->move('teachers-photos/',$original_name);

        $create_teacher_to_teacher_table =new teacher;
        $create_teacher_to_teacher_table ->school_id = $this->authenticated_user->getLoggedInUserID();
        $create_teacher_to_teacher_table->level_id      = request()->level_id;
        $create_teacher_to_teacher_table->subject_id     = request()->subject_id;
        $create_teacher_to_teacher_table->teachers_login_id  = request()->teachers_login_id;
        //$create_teacher_to_teacher_table->photo  = $original_name;
        $create_teacher_to_teacher_table->photo  = request()->photo;
        $create_teacher_to_teacher_table->save();

        $save_teacher_to_user_table =new User();
        $save_teacher_to_user_table->name      =request()->name;
        $save_teacher_to_user_table->email     =request()->email;
        $save_teacher_to_user_table->password  =Hash::make($save_teacher_to_user_table['password']);
        $save_teacher_to_user_table->save();
        return Redirect()->back()->withErrors("Teachers Information has been created successfully");
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
            return redirect()->back()->withErrors('Student Name is required, please fill it to continue');
        }elseif(empty(request()->name)){
            return redirect()->back()->withErrors('Name is required, please fill it to continue');
        }elseif(empty(request()->email)){
            return redirect()->back()->withErrors('Email is required, please fill it to continue');
        }elseif(empty(request()->password)){
            return redirect()->back()->withErrors('Password is required, please fill it to continue');
       
        }else{
            return $this->submitTeacher();
        }
    }
    /** 
     * This function deletes teachers softly
    */
    protected function deleteTeacher($id){
        teacher::where('id',$id)->delete();
        return Redirect()->back()->withErrors("Teacher has been deleted successfully");
    }
}
