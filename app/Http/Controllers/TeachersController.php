<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\teacher;
use App\User;

class TeachersController extends Controller
{
<<<<<<< HEAD
     /** 
      * creating an instance of the authenticated user
      */
      public function __construct(){
        $this->authenticated_teacher = new AuthenticationController;
=======
    /** 
     * creating an instance of the authenticated user
    */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
>>>>>>> 81f91c198e1946e28732c94918b29466c5c916f2
    }
    /** 
     * This function fetches all the teachers from both users and teacher table
    */
    protected function getTeachers(){
        $get_all_teachers =teacher::join('users','teachers.school_id','users.id')
        ->join('levels','teachers.level_id','levels.id')
        ->join('subjects','teachers.subject_id','subjects.id')
        ->where('users.id',$this->authenticated_teacher->getLoggedinTeachersId())
        ->get();
        return response()->json([$get_all_teachers,200]);
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
        $create_teacher_to_teacher_table ->school_id = $this->authenticated_teacher->getLoggedInUserID();
        $create_teacher_to_teacher_table->level_id      = request()->level_id;
        $create_teacher_to_teacher_table->subject_id     = request()->subject_id;
        $create_teacher_to_teacher_table->teachers_login_id  = $this->authenticated_teacher->getLoggedinTeachersId();
        //$create_teacher_to_teacher_table->photo  = $original_name;
        $create_teacher_to_teacher_table->photo  = request()->photo;
        $create_teacher_to_teacher_table->save();

        $save_teacher_to_user_table =new User();
        $save_teacher_to_user_table->name      =request()->name;
        $save_teacher_to_user_table->email     =request()->email;
        $save_teacher_to_user_table->password  =Hash::make($save_teacher_to_user_table['password']);
        $save_teacher_to_user_table->save();
    }
    /** 
     * This function edits the teacher information
    */
    protected function editTeacher($id){
        User::where('id',$id)->update(array(
            'name' =>'Ociba Flaviuos'
        ));
<<<<<<< HEAD
=======
        return Redirect()->back()->withErrors("Teacher Information has been updated successfully");
>>>>>>> 81f91c198e1946e28732c94918b29466c5c916f2
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
        teacher::where('id',$id)->update(array( 'status' => 'deleted'));
    }
}
