<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\teacher;

class TeacherTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testCreateTeacher(){
        $response=$this->post('/create-teacher',[
            'school_id'        =>'1',
            'level_id'         =>'1',
            'subject_id'       =>'1',
            'teachers_login_id'=>'1',
            'photo'            =>'image.jpg',
            'status'=> 'active',
            'name'  =>'Opio John',
            'email' =>'opiojohn@gmail.com',
            'password' =>'0785401795o'
        ]);
           $this->assertCount(1,teacher::all());
           // $this->assertCount(1,User::all());
    }
     /** @test */
    public function getTeacher(){
        $response = $this->get('/get-teacher');

        $response->assertStatus(200);
    }
    /** @test */
    public function testEditTeacher(){
        $this->withoutExceptionHandling();
        $this->testCreateTeacher();
        $teacher = User::first();
        $response = $this->patch('edit-teacher/'.$teacher->id);
        $this->assertEquals('Ociba Flaviuos', User::first()->name);
    }
     /** @test */
     public function testDeleteTeacher(){
        $this->withoutExceptionHandling();
        $this->testCreateTeacher();
        $delete_teacher = teacher::first();
        $response = $this->delete('delete-teacher/'.$delete_teacher->id);
        $this->assertCount(1, teacher::all());
    }
}
