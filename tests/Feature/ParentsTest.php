<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\ParentInformation;

class ParentsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testCreateParent(){
        $response=$this->post('create-parent',[
            'parent_name'=>'Anabo Brenda',
            'contact'=>'0785401795',
            'location'=>'Ngora'
        ]);
           $this->assertCount(1,ParentInformation::all());
    }
    /** @test */
    public function testGetParent(){
        $response = $this->get('/parent-information');

        $response->assertStatus(200);
    }
    /** @test */
    public function testEditParent(){
        $this->withoutExceptionHandling();
        $this->testCreateParent();
        $parent_information = ParentInformation::first();
        $response = $this->patch('edit-parent/'.$parent_information->id);
        $this->assertEquals('Ociba James', ParentInformation::first()->parent_name);
    }
    /** @test */
    public function testDeleteParent(){
        $this->withoutExceptionHandling();
        $this->testCreateParent();
        $delete_parent = ParentInformation::first();
        $response = $this->delete('delete-parent/'.$delete_parent->id);
        $this->assertCount(1, ParentInformation::all());
    }
}
