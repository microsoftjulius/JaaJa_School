<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Subject;

class SubjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testCreateSubject(){
        $response=$this->post('create-subject',[
            'subject'=>'mathematics'
        ]);
           $this->assertCount(1,Subject::all());
    }
    /** @test */
    public function testGetSubject(){
        $response = $this->get('/display-subject');

        $response->assertStatus(200);
    }
    /** @test */
    public function testEditSubject(){
        $this->withoutExceptionHandling();
        $this->testCreateSubject();
        $subject = Subject::first();
        $response = $this->patch('edit-subject/'.$subject->id);
        $this->assertEquals('English', Subject::first()->subject);
    }
    /** @test */
    public function testDeleteSubject(){
        $this->withoutExceptionHandling();
        $this->testCreateSubject();
        $delete_subject = Subject::first();
        $response = $this->delete('delete-subject/'.$delete_subject->id);
        $this->assertCount(1, Subject::all());
    }
}
