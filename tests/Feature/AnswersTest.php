<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Questions;
use App\AnswersModel;

class AnswersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * This function creates answers for the question
     * @test
     */
    public function createAnswers(){
        $this->withoutExceptionHandling();
        $question_id = 1;
        $response = $this->post('/create-answers/'.$question_id,[
            'answer_pdf'  => 'answer.pdf'
        ]);
        $this->assertDatabaseHas('answers',['answer_pdf'=>'answer.pdf']);
    }

    /**
     * This function gets all the answers, for a question
     * @test
     */
    public function getAnswersToAQuestion(){
        $this->createAnswers();
        $question_id = 1;
        $response = $this->get('/get-answers-to-question/'.$question_id);
        $response->assertOk();
    }

    /**
     * this function updates the question
     * @test
     */
    public function updateAnswers(){
        $this->createAnswers();
        $question_id = 1;
        $response = $this->patch('/update-answers-to-question/'.$question_id,[
            'answer_pdf'=>'answer_2.pdf']
        );
        $this->assertDatabaseHas('answers',['answer_pdf'=>'answer_2.pdf']);
    }

    /**
     * This function delets the answers
     */
    public function deleteAnswer(){
        $this->createAnswers();
        $question_id = 1;
        $response = $this->delete('/delete-answers-to-question/'.$question_id);
        $this->assertCount(0, AnswersModel::all());
    }
}
