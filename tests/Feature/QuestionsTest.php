<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionsTest extends TestCase
{
<<<<<<< HEAD
    use RefreshDatabase;

    /**
     * This function is a test function for creating a Question
     * the uploaded questions are in form of a pdf
     * @test
     */
    public function createAQuestions(){
        $this->withoutExceptionalHandling();
        $response = $this->post('/create-questions',[
            'class_id'      => 1,
            'teacher_id'    => 1,
            'questions_pdf' => 'pdf_link'
        ]);
        $this->assertDatabaseHas('1',['class_id'=>1]);
=======
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
>>>>>>> f3806f1080320ce79473786aefece635efcf8d60
    }
}
