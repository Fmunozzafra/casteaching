<?php

namespace Tests\Feature\Traits;

use Illuminate\Support\Facades\Auth;

trait CanLogin
{
    private function loginAsSeriesManager()
    {
        Auth::login($user = create_series_manager_user());
        return $user;
    }

    private function loginAsVideoManager()
    {
        Auth::login(create_video_manager_user());
    }

    private function loginAsSuperAdmin()
    {
        Auth::login(create_superadmin_user());
    }

    private function loginAsRegularUser()
    {
        Auth::login(create_regular_user());
    }
}
