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
        //$this->withoutExceptionHandling();
        $response=$this->post('/create-role',[
            'role' =>'school',
            'id'=> '1'
        ]);
        $this->assertCount(0,Role::all());
    
    }
    /** @test*/
    public function testGetRole(){
        $response = $this->get('/get-role');

        $response->assertStatus(200);
    }
    
}
