<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class usersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function createUser(){
        $response=$this->post('/create-user',[
            'role_id'  =>'1',
            'name'     => 'gayaza primary school',
            'email'    => 'gayazaps@gmail.com',
            'password' => '0775401793o',
            'status'=> 'active'
        ]);
            $this->assertCount(1,User::all());
    }
    /** @test */
    public function getuser(){
        $response = $this->get('/get-user');

        $response->assertStatus(200);
    }
    /** @test */
    public function testEditUser(){
        $this->withoutExceptionHandling();
        $this->createUser();
        $user = User::first();
        $response = $this->patch('edit-user/'.$user->id);
        $this->assertEquals('Ntinda primary school', User::first()->name);
    }
     /** @test */
     public function testDeleteUser(){
        $this->withoutExceptionHandling();
        $this->createUser();
        $delete_user = User::first();
        $response = $this->delete('delete-user/'.$delete_user->id);
        $this->assertCount(1, User::all());
    }
     
}
