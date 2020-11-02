<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\PastPapersModel as PastPaper;

class PastPapersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * This function creates the past papers
     * @test
     */
    public function createPastPaper(){
        $this->withoutExceptionHandling();
        $response = $this->post('/add-new-past-paper',[
            'class_name' => 'Primary Seven',
            'past_paper_pdf' => 'past_papers.pdf'
        ]);
        $this->assertDatabaseHas('past_papers',['class_id' =>1]);
    }

    /**
     * This function tests the geting of all past papers
     * @test
     */
    public function getPastPapers(){
        $this->createPastPaper();
        $response = $this->get('/get-past-papers');
        $response->assertOk();
    }

    /**
     * This function updates the past papers
     * @test
     */
    public function updatePastPapers(){
        $this->createPastPaper();
        $past_paper_id = PastPaper::first()->id;
        $response = $this->patch('/update-past-paper/'.$past_paper_id,[
            'class_name' => 'Primary Six',
        ]);
        $this->assertDatabaseHas('past_papers',['class_id' =>2]);
    }

    /**
     * This function deletes the past papers
     * @test
     */
    public function deletePastPaper(){
        $this->createPastPaper();
        $past_paper_id = PastPaper::first()->id;
        $response = $this->delete('/delete-past-paper/'.$past_paper_id);
        $this->assertCount(0,PastPaper::all());
    }
}
