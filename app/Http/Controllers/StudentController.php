<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\User;
use App\ParentInformation as Parents;
use App\level;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
        $this->user_instance      = new UserController;
        $this->parents_instance   = new ParentController;
        $this->classes_instance   = new LevelController;
    }
    /** 
     * This function fetches all the students from students table
    */
    protected function getStudents(){
        $parents = $this->parents_instance->getParentsCollection();
        $classes = $this->classes_instance->getClassesCollection();
        $get_all_students = Student::join('users','students.school_id','users.id')
        ->join('levels','students.level_id','levels.id')
        ->join('parent_information','students.parent_id','parent_information.id')
        ->select('parent_information.parent_name','users.name','students.*','levels.class')
        ->get();
        return view('admin.student', compact('get_all_students','parents','classes'));
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
    private function submitStudent($photo_path, $parent_contact, $first_name, $parent_id, $class_id){
        if(User::where('email',$parent_contact)->exists()){
            return redirect()->back()->withErrors("An Account having this contact already exists, Please consider using a new contact");
        }
        //creating a student with username as last name and password as parents contact
        $this->user_instance->createUser(request()->first_name . ' '. $first_name, 
                                        $first_name, $parent_contact, 'student');
        //getting the parents Id from the users table
        $student_login_id = User::where('email',$first_name)->value('id');
        //creating a parent
        $create_students_to_student_table                   = new Student;
        $create_students_to_student_table->school_id        = $this->authenticated_user->getLoggedInUserID();
        $create_students_to_student_table->level_id         = $class_id;
        $create_students_to_student_table->parent_id        = $parent_id;
        $create_students_to_student_table->student_name     = request()->first_name . ' ' .request()->last_name;
        $create_students_to_student_table->age              = request()->age;
        $create_students_to_student_table->student_login_id = $student_login_id;
        $create_students_to_student_table->photo            = $photo_path;
        $create_students_to_student_table->save();
        return Redirect()->back()->with('msg',"Student Information has been created successfully, Student can now login with Username : ". $first_name . " and Password as ". $parent_contact);
    }
    /** 
     * This function validates students information to be submitted
    */
    protected function validatesubmitStudent(){
        if(empty(request()->last_name)){
            return redirect()->back()->withErrors('Last Name is required, please fill it to continue')->withInput();
        }elseif(empty(request()->first_name)){
            return redirect()->back()->withErrors('First Name is required, please fill it to continue')->withInput();
        }elseif(empty(request()->age)){
            return redirect()->back()->withErrors('Age is required, please fill it to continue')->withInput();
        }elseif(empty(request()->photo)){
            return redirect()->back()->withErrors('Photo is required, please attach it to continue')->withInput();
        }else{
            //getting the last name of the student
            $first_name = request()->first_name;
            //check if it exists, if so, add a figure to it. the figure is a maximum id
            if(User::where('email',$first_name)->exists()){
                $first_name = $first_name . User::Max('id');
            }
            //getting the parents contact
            if(Parents::where('parent_name',request()->parent_name)->exists()){
                if(level::where('class',request()->class_name)->exists()){
                    $parent_contact = Parents::where('parent_name',request()->parent_name)->value('contact');
                    $parent_id      = Parents::where('parent_name',request()->parent_name)->value('id');
                    $class_id       = level::where('class',request()->class_name)->value('id');
                    $student_photo = request()->photo;
                    $photo_path = $student_photo->getClientOriginalName();
                    $student_photo->move('student_photo/',$photo_path);
                    return $this->submitStudent($photo_path, $parent_contact, $first_name, $parent_id, $class_id);
                }else{
                    return redirect()->back()->withErrors("You need to create a class called " . request()->class_name . " and then add the Student to it")->withInput();
                }
            }else{
                return redirect()->back()->withErrors("You need to create this parent in order to add a student for him or her");
            }
        }
    }
    /** 
     * This function deletes users softly
    */
    protected function deleteStudent($id){
        Student::where('id',$id)->delete();
        return Redirect()->back()->with('msg',"You Successfully performed a delete operation on a student");
    }
}
