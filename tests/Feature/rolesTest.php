<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Role;

class rolesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** 
     * @test
    */

    public function testCreateRole(){
        $response=$this->post('/create-role',[
            'role' =>'school',
            'status'=> 'active'
        ]);
            $this->assertCount(0,Role::all());
    
    }
    /** @test*/
    public function testGetRole(){
        $response = $this->get('/get-role');

        $response->assertStatus(200);
    }
    /** @test*/
    public function testEditRole(){
        $this->withoutExceptionHandling();
        $this->testCreateRole();
        $role = Role::first();
        $response = $this->patch('edit-role/'.$role->id);
        $this->assertEquals('admin', Role::first()->role);
    }
    
    /** @test */
    public function testDeleteRole(){
        $this->withoutExceptionHandling();
        $this->testCreateRole();
        $delete_role = Role::first();
        $response = $this->delete('delete-role/'.$delete_role->id);
        $this->assertCount(1, Role::all());
    }
}
