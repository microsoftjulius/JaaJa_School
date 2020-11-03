<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeWorkMarks;

class HomeWorkMarksController extends Controller
{
    /** 
      * creating an instance of the authenticated user
      */
    public function __construct(){
        $this->authenticated_user = new AuthenticationController;
    }
    /**
     * This function validates the marks for home work added by the teacher
     */
    protected function validateStudentsMarks($home_work_id){
        if(empty(request()->marks)){
            return redirect()->back()->withError("No marks added for this candidate, kindly add the marks");
        }if(HomeWorkMarks::where('id',$home_work_id)->where('student_id',$this->authenticated_user->getLoggedInStudentsId())->exists()){
            return redirect()->back()->withErrors(" This student already has marks for this home work, consider editing the marks");
        }else{
            $student_id = $this->authenticated_user->getLoggedInStudentsId();
            $teacher_id = $this->authenticated_user->getLoggedinTeachersId();
            $school_id  = $this->authenticated_user->getLoggedInUserID();
            $marks      = request()->marks;
            return $this->addStudentsHomeWorkMarks($student_id, $teacher_id, $school_id, $home_work_id, $marks);
        }
    }

    /**
     * This function adds the marks for the student
     */
    private function addStudentsHomeWorkMarks($student_id, $teacher_id, $school_id, $home_work_id, $marks){
        $new_homework_marks = new HomeWorkMarks;
        $new_homework_marks->student_id   = $student_id;
        $new_homework_marks->teacher_id   = $teacher_id;
        $new_homework_marks->school_id    = $school_id;
        $new_homework_marks->home_work_id = $home_work_id;
        $new_homework_marks->marks        = $marks;
        $new_homework_marks->save();
        return redirect()->back()->with('msg','Student Marks For HomeWork have been added successfully');
    }

    /**
     * This function updates marks for the student for a particular home work
     */
    protected function updateStudentMarks($home_work_id){
        HomeWorkMarks::where('id',$home_work_id)->update(array(
            'marks' => request()->marks
        ));
        return redirect()->back()->with('msg','Student Marks For HomeWork have been updated successfully');
    }

    /**
     * This function gets all the marks for the students by a teacher of the subject
     */
    protected function getAllStudentsWithMarks($home_work_id){
        return $this->getAllStudentsWithMarksCollection($home_work_id);
    }

    /**
     * This function gets the collection of the students
     */
    private function getAllStudentsWithMarksCollection($home_work_id){
        return HomeWorkMarks::where('teacher_id', $this->authenticated_user->getLoggedinTeachersId())
        ->where('home_work_id',$home_work_id)
        ->get();
    }

    /**
     * This function deletes the marks of the student by the teacher
     */
    protected function deleteHomeworkMarksForStudent($marks_id){
        HomeWorkMarks::find($marks_id)->delete();
        return redirect()->back()->with('msg',' You successfully deleted marks for the student that might have been added accidentaly');
    }
}
