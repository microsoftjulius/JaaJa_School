<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\HomeWorkMarks;
use Tests\TestCase;

class HomeWorkMarksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The teacher creates marks for a a submited homework per student
     * @test
     */

    public function addStudentMarks(){
        $this->withoutExceptionHandling();
        $response = $this->post('/add-marks-to-student-for-homework-answers/1',[
            'marks' => 90
        ]);
        $this->assertDatabaseHas('home_work_marks',["marks"=>90]);
    }

    /**
     * A teacher can update the marks for a student
     * @test
     */
    public function updateStudentMarks(){
        $this->addStudentMarks();
        $response = $this->patch('/update-student-marks-for-homework-answers/1',[
            'marks' => 85
        ]);
        $this->assertDatabaseHas('home_work_marks',["marks"=>85]);
    }

    /**
     * A teacher can see all the marks per subject they clicked on, the marks include students names
     * @test
     */
    public function getAllMarksForAllStudentsInASubject(){
        $this->addStudentMarks();
        $response = $this->get('/get-all-students-with-their-marks/1');
        $response->assertOk();
    }

    /**
     * A teacher can delete the marks of the student (For only a teacher who added the home work)
     * @test
     */
    public function deleteStudentMarks(){
        $this->addStudentMarks();
        $response = $this->delete('/delete-student-marks/1');
        $this->assertCount(0,HomeWorkMarks::all());
    }
}
