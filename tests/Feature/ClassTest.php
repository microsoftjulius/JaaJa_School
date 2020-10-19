<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\level;

class ClassTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testCreateClass(){
        $response=$this->post('/create-class',[
            'class'=>'primary seven'
        ]);
           $this->assertCount(1,level::all());
    }
    /** @test */
    public function testGetClass(){
        $response = $this->get('/get-class');

        $response->assertStatus(200);
    }
    /** @test */
    public function testEditClass(){
        $this->withoutExceptionHandling();
        $this->testCreateClass();
        $class = level::first();
        $response = $this->patch('edit-class/'.$class->id);
        $this->assertEquals('P.7', level::first()->class);
    }
    /** @test */
    public function testDeleteClass(){
        $this->withoutExceptionHandling();
        $this->testCreateClass();
        $delete_class = level::first();
        $response = $this->delete('delete-class/'.$delete_class->id);
        $this->assertCount(1, level::all());
    }
}
