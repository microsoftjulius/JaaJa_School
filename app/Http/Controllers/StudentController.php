<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\User;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
     /** 
      * creating an instance of the authenticated user
      */
     public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }
    /** 
     * This function fetches all the students from students table
    */
    protected function getStudent(){
        $get_all_students =Student::join('users','students.school_id','users.id')
        ->join('levels','students.level_id','levels.id')
        ->join('parents','students.parent_id','parents.id')
        ->where('students.id',$this->authenticated_user->getLoggedInUserID())
        ->get();
        return view('admin.student', compact('get_all_students'));
    }
    /** 
     * This function edits the student information
    */
    protected function editStudent($id){
        Student::where('id',$id)->update(array(
            'student_name' =>'Oliba Moses Ociba',
            'age'=>'24'
        ));
       
        return Redirect()->back()->withErrors("Student Information has been updated successfully");
    }
    /** 
     * This function creates student details 
     * It saves both to users table and students Table
    */
    private function submitStudent(){
        $create_students_to_student_table =new Student;
        $create_students_to_student_table ->school_id = $this->authenticated_user->getLoggedInUserID();
        $create_students_to_student_table->level_id      = request()->level_id;
        $create_students_to_student_table->parent_id     = request()->parent_id;
        $create_students_to_student_table->student_name  = request()->student_name;
        $create_students_to_student_table->age           = request()->age;
        $create_students_to_student_table->save();

        $save_student_to_user_table =new User();
        $save_student_to_user_table->name      =request()->name;
        $save_student_to_user_table->email     =request()->email;
        $save_student_to_user_table->password  =Hash::make($save_student_to_user_table['password']);
        $save_student_to_user_table->save();
        return Redirect()->back()->withErrors("Student Information has been created successfully");
    }
    /** 
     * This function validates students information to be submitted
    */
    protected function validatesubmitStudent(){
        if(empty(request()->student_name)){
            return redirect()->back()->withErrors('Student Name is required, please fill it to continue');
        }elseif(empty(request()->age)){
            return redirect()->back()->withErrors('Age is required, please fill it to continue');
        }elseif(empty(request()->name)){
            return redirect()->back()->withErrors('Name is required, please fill it to continue');
        }elseif(empty(request()->email)){
            return redirect()->back()->withErrors('Email is required, please fill it to continue');
        }elseif(empty(request()->password)){
            return redirect()->back()->withErrors('Password is required, please fill it to continue');
       
        }else{
            return $this->submitStudent();
        }
    }
     /** 
     * This function deletes users softly
    */
    protected function deleteStudent($id){
        Student::where('id',$id)->update(array( 'status' => 'deleted'));
        return Redirect()->back()->withErrors("Student has been deleted successfully");
    }
}
