<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

if(! function_exists('create_default_user')) {
    function create_default_user() {


        $user = User::create([
            'name' => config('casteaching.default_user.name','Ferran Munoz Zafra'),
            'email' => config('casteaching.default_user.email','fmunoz@iesebre.com'),
            'password' => Hash::make(config('casteaching.default_user.password','12345678'))
        ]);

        try {
            Team::create([
                'name' => $user->name . "'s Team",
                'user_id' => $user->id,
                'personal_team' => true
            ]);
        } catch (\Exception $exception) {

        }

    }
}

if(! function_exists('create_default_video')) {
    function create_default_videos()
    {

        Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Here description',
            'url' => 'https://www.youtube.com/watch?v=6SxjClAdXZ8',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);
    }
}
