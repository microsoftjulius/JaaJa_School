<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Questions;

class QuestionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * This function is a test function for creating a Question
     * the uploaded questions are in form of a pdf
     * @test
     */
    public function createQuestions(){
        $this->withoutExceptionHandling();
        $response = $this->post('/create-questions',[
            'class_id'      => 1,
            'questions_pdf' => 'pdf_link'
        ]);
        $this->assertDatabaseHas('questions',['class_id'=>1]);
    }

    /**
     * This function is a test function for editing the Questions that have been uploaded
     * @test
     */
    public function editQuestions(){
        $this->createQuestions();
        $question_id = Questions::first();
        $response = $this->patch('/edit-questions/'.$question_id->id,[
            'questions_pdf' => 'pdf_link_1',
            'class_id'      => 2
        ]);
        $this->assertDatabaseHas('questions',['class_id'=>2]);
    }

    /**
     * This function gets all the questions. All Students can view all the questions
     * @test
     */
    public function getAllQuestions(){
        $this->createQuestions();
        $response = $this->get('/get-all-questions');
        $response->assertOk();
    }
}
