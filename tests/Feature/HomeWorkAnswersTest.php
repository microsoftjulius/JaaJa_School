<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeWorkAnswersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * This function creates the home work answers by a student
     * @test
     */
    public function createHomeworkAnswers(){
        $this->withoutExceptionHandling();
        $response = $this->post('/answers-for-homework/1',[
            'answers_pdf' => 'homework.pdf'
        ]);
        $this->assertDatabaseHas('home_work_answers',['answer_pdf'=>'homework.pdf']);
    }

    /**
     * Students can be able to change the submission provided the deadline has not yet reached
     * @test
     */
    public function changeSubmitedWork(){
        $this->createHomeworkAnswers();
        $response = $this->patch('/change-submited-answers-for-homework/1',[
            'answers_pdf' => 'myanswers.pdf'
        ]);
        $this->assertDatabaseHas('home_work_answers',['answer_pdf'=>'myanswers.pdf']);
    }

    /**
     * The students can view their submissions
     * @test
     */
    public function getMyHomeworkSubmissions(){
        $this->createHomeworkAnswers();
        $response = $this->get('/get-my-home-work-submissions');
        $response->assertOk();
    }

    /**
     * The teacher can view all the submitted homeworks per subject they select
     * @test
     */
    public function getAllHomeworksForThisSubject(){
        $this->createHomeworkAnswers();
        $response = $this->get('/get-homework-submissions-for-subject/1');
        $response->assertOk();
    }
}
