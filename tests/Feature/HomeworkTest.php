<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Homework;

class HomeworkTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testCreateHomeWork(){
        $response=$this->post('/create-home-work',[
            'school_id'  =>'1',
            'level_id'   =>'1',
            'subject_id' =>'1',
            'teacher_id' =>'1',
            'home_work'  =>'mathematics.pdf',
            'status'     =>'active'
        ]);
           $this->assertCount(1,Homework::all());
    }
    /** @test */
    public function testGetHomeWork(){
        $response = $this->get('get-home-work');

        $response->assertStatus(200);
    }
    /** @test */
    public function testEditHomeWork(){
        $this->withoutExceptionHandling();
        $this->testCreateHomeWork();
        $homw_work = Homework::first();
        $response = $this->patch('edit-home-work/'.$homw_work->id);
        $this->assertEquals('English.pdf', Homework::first()->home_work);
    }
    /** @test */
    public function testDeleteHomeWork(){
        $this->withoutExceptionHandling();
        $this->testCreateHomeWork();
        $delete_work = Homework::first();
        $response = $this->delete('delete-home-work/'.$delete_work->id);
        $this->assertCount(0, Homework::all());
    }
}
