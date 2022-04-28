<?php

namespace Tests\Unit;

use App\Models\Video;
use App\Models\User;
use App\Models\Serie;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
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
            'serie_id' => 1
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
            'serie_id' => 1
        ]);
        //2 Execució
        $dateToTest = $video->formatted_published_at;
        // Comprovació
        $this->assertEquals($dateToTest, '');
    }


    /**
     * @test
     */
    public function video_have_serie()
    {
        $video = Video::create([
            'title' => 'TDD 101',
            'description' => 'Bla bla bla',
            'url' => 'https://youtu.be/w8j07_DBl_I',
        ]);

        $this->assertNull($video->serie);

        $serie = Serie::create([
            'title' => 'Apren TDD',
            'description' => 'Bla bla bla',
            'image' => 'tdd.png',
            'teacher_name' => 'Sergi Tur Badenas',
            'teacher_photo_url' => 'https://www.gravatar.com/avatar/' . md5('sergiturbadenas@gmail.com'),
        ]);

        $video->setSerie($serie);

        $this->assertNotNull($video->fresh()->serie);

    }
    /** @test */
    public function video_can_have_owners()
    {
        $user = User::create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@casteaching.com',
            'password' => Hash::make('12345678')
        ]);

        $video  = Video::create([
            'title' => 'TDD 101',
            'description' => 'Bla bla bla',
            'url' => 'https://youtu.be/ednlsVl-NHA'
        ]);

        $this->assertNull($video->owner);
        $video->setOwner($user);
        $this->assertNotNull($video->fresh()->user);
        $this->assertEquals($video->user->id,$user->id);
    }
}
