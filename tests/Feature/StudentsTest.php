<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Student;
use App\User;

class StudentsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testCreateStudent(){
        $response=$this->post('create-student',[
            'school_id'=>'1',
            'level_id'=>'1',
            'parent_id'=>'1',
            'student_name'=>'Oliba Moses',
            'age' =>'12',
            'status'=> 'active',
            'name'  =>'Atapar primary school',
            'email' =>'ataparps@gmail.com',
            'password' =>'077540179300'
        ]);
           $this->assertCount(1,Student::all());
           // $this->assertCount(1,User::all());
    }
     /** @test */
    public function getStudent(){
        $response = $this->get('/get-student');

        $response->assertStatus(200);
    }
    /** @test */
    public function testEditStudent(){
        $this->withoutExceptionHandling();
        $this->testCreateStudent();
        $student = Student::first();
        $response = $this->patch('edit-student/'.$student->id);
        $this->assertEquals('Oliba Moses Ociba', Student::first()->student_name);
    }
     /** @test */
     public function testDeleteStudent(){
        $this->withoutExceptionHandling();
        $this->testCreateStudent();
        $delete_student = Student::first();
        $response = $this->delete('delete-student/'.$delete_student->id);
        $this->assertCount(1, Student::all());
    }
}
