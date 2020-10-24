<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TutorialsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * This function creates the tutorials
     * @test
     */
    public function createTutorials(){
        $this->withoutExceptionHandling();
        $answer_id = 1;
        $response = $this->patch('/create-new-tutorial-for-answer/'.$answer_id,[
            'youtube_video_url'=>'https://youtu.be/ibI1KF98Pok',
        ]);
        $response->assertOk();
    }

    /**
     * This function updates the youtube tutorial
     * @test
     */
    public function updateYoutubeVideo(){
        $this->createTutorials();
        $tutorial_id = 1;
        $response = $this->patch('/update-video-tutorial/'.$tutorial_id,[
            'youtube_video_url' => 'https://youtu.be/dEjfM9E8zPc',
        ]);
        $response->assertOk();
    }
}
