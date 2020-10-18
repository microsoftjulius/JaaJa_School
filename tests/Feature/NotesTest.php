<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Note;

class NotesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testCreateNotes(){
        $response=$this->post('/create-notes',[
            'level_id'   =>'1',
            'subject_id' =>'1',
            'teacher_id' =>'1',
            'notes'  =>'mathematics.pdf',
            'status'     =>'active'
        ]);
           $this->assertCount(1,Note::all());
    }
    /** @test */
    public function testGetNotes(){
        $response = $this->get('/display-notes');

        $response->assertStatus(200);
    }
    /** @test */
    public function testEditNotes(){
        $this->withoutExceptionHandling();
        $this->testCreateNotes();
        $notes = Note::first();
        $response = $this->patch('edit-notes/'.$notes->id);
        $this->assertEquals('English.pdf', Note::first()->notes);
    }
    /** @test */
    public function testDeleteNotes(){
        $this->withoutExceptionHandling();
        $this->testCreateNotes();
        $delete_notes = Note::first();
        $response = $this->delete('delete-notes/'.$delete_notes->id);
        $this->assertCount(0, Note::all());
    }
}
