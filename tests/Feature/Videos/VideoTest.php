<?php

namespace Tests\Feature\Videos;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoTest extends TestCase
{
    /**
     *
     * @test
     */
    public function users_can_view_videos()
    {
        // FASE 1 -> Preparació -> Prepare
        //WISHFUL PROGRAMMING
        $video = Video::create([
                'title' => 'Ubuntu 101',
                'description' => 'Descripcio',
                'url' => 'https://www.youtube.com/watch?v=6SxjClAdXZ8',
                'published_at' => Carbon::parse('December 31, 2020 8:00pm'),
                'completed' => false,
                'previous' => null,
                'next' => null,
                'series_id' => 1
        ]);

        //FASE 2 -> Execució -> Executa el codi a provar
        //Laravel HTTP test
        $response = $this->get('/videos/' . $video->id);

        //FASE 3 -> Assertions -> comprovacions
        $response->assertStatus(200);
        $response->assertSee('Ubuntu 101');
        $response->assertSee('Here description');
        $response->assertSee('December 13');
    }
}
