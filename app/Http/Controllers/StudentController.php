<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\User;
use App\ParentInformation as Parents;
use App\level;
use Illuminate\Support\Facades\Hash;
use DB;

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
        $all_users = User::where('id','!=',auth()->user()->id)->get();
        $roles = DB::table('roles')->get();
        $get_all_students = Student::join('users','students.student_login_id','users.id')
        ->join('roles','roles.id','users.role_id')
        ->join('levels','students.level_id','levels.id')
        ->join('parent_information','students.parent_id','parent_information.id')
        ->select('parent_information.parent_name','users.name','students.*','levels.class','roles.role')
        ->get();
        return view('admin.student', compact('get_all_students','parents','classes','all_users','roles'));
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
    private function submitStudent($photo_path, $parent_contact, $first_name, $parent_id, $class_id, $role_id){
        //creating a student with username as first name and password as parents contact
        $this->user_instance->createUser(request()->last_name . ' '. $first_name, 
                                        $first_name, $parent_contact, 'student', $role_id);
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
        }elseif(empty(request()->role)){
            return redirect()->back()->withErrors("Please select a role to assign to this student")->withInput();
        }elseif(DB::table('roles')->where('role',request()->role)->exists()){
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
                    $role_id = DB::table('roles')->where('role',request()->role)->value('id');
                    return $this->submitStudent($photo_path, $parent_contact, $first_name, $parent_id, $class_id, $role_id);
                }else{
                    return redirect()->back()->withErrors("You need to create a class called " . request()->class_name . " and then add the Student to it")->withInput();
                }
            }else{
                return redirect()->back()->withErrors("You need to create this parent in order to add a student for him or her");
            }
        }else{
            return redirect()->back()->withErrors("Please select a role from the list, In order to create a new role, go to settings")->withInput();
        }
    }
    /** 
     * This function deletes users softly
    */
    protected function suspendStudent($id){
        $student_login_id = Student::where('id',$id)->value('student_login_id');
        User::where('id',$student_login_id)->update(array('status'=>'suspended'));
        Student::where('id',$id)->update(array(
            'status' => 'suspended'
        ));
        return Redirect()->back()->with('msg',"Your request to suspend a student was successful");
    }

    /**
     * This function activates the student
     */
    protected function activateStudent($id){
        $student_login_id = Student::where('id',$id)->value('student_login_id');
        User::where('id',$student_login_id)->update(array('status'=>'active'));
        Student::where('id',$id)->update(array(
            'status' => 'active'
        ));
        return Redirect()->back()->with('msg',"Your request to activate a student was successful");
    }
}
