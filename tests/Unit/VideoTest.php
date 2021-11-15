<?php

namespace Tests\Unit;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_get_formatted_published_at_date()
    {
        //1 Preparació
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Here description',
            'url' => 'https://www.youtube.com/watch?v=6SxjClAdXZ8',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);
        //2 Execució
        $dateToTest = $video->formatted_published_at;
        // Comprovació
        $this->assertEquals($dateToTest, '13 de desembre de 2020');
    }

    /**
     * @test
     */
    public function can_get_formatted_published_at_date_when_not_published()
    {
        //1 Preparació
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Here description',
            'url' => 'https://www.youtube.com/watch?v=6SxjClAdXZ8',
            'published_at' => null,
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);
        //2 Execució
        $dateToTest = $video->formatted_published_at;
        // Comprovació
        $this->assertEquals($dateToTest, '');
    }
}
