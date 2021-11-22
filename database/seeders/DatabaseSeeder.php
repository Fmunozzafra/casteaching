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
        create_default_user();

        create_superadmin_user();

        create_regular_user();

        create_default_videos();

        create_sample_videos();

        create_permissions();

        create_video_manager_user();
    }
}
