<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //Crear un usuari propi pero també per a professor
        User::create([
           'name' => 'Ferran Munoz Zafra',
           'email' => 'fmunoz@iesebre.com',
           'password' => Hash::make(config('casteaching.default_user.password'))
        ]);

        //Refactorització -> Helper -> create_default_videos() -> Helper -> PHP
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
