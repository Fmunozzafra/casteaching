<?php

namespace Tests\Feature\Videos;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

/**
* @covers \App\Http\Controllers\VideosManageControllerTest
*/

class VideosManageControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function user_with_permissions_can_store_videos(){
        $this->loginAsVideoManager();

        $video = objectify([
            'title' => 'HTTP for noobs',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);

        // API ENDPOINT
        $response = $this->post('/manage/videos',[
            'title' => 'HTTP for noobs',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);

        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('status', 'Successfully created');

        // 3 Asserting
        $videoDB = Video::first();

        $this->assertNotNull($videoDB);
        $this->assertEquals($videoDB->title,$video->title);
        $this->assertEquals($videoDB->description,$video->description);
        $this->assertEquals($videoDB->url,$video->url);
        $this->assertNull($video->published_at);

    }

    /**
     * @test
     */
    public function user_with_permissions_can_see_add_videos()
    {
        $this->loginAsVideoManager();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');

        $response->assertSee('<form data-qa="form_video_create"',false);
    }

    /** @test  */
    public function user_without_videos_manage_create_cannot_see_add_videos()
    {
        Permission::firstOrCreate(['name' => 'videos_manage_index']);
        $user = User::create([
            'name' => 'Pepe',
            'email' => 'Pepe',
            'password' => Hash::make('12345678')
        ]);
        $user->givePermissionTo('videos_manage_index');
        add_personal_team($user);

        Auth::login($user);

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');

        $response->assertDontSee('<form data-qa="form_video_create"',false);
    }

    /**
     * @test
     */
    public function user_with_permissions_can_manage_videos()
    {
        $this->loginAsVideoManager();

        $videos = create_sample_videos();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
        $response->assertViewHas('videos',function($v) use ($videos) {
            return $v->count() === count($videos) && get_class($v) === Collection::class &&
                get_class($videos[0]) === Video::class;
            return $v->count() === count($videos) && get_class($v) === Collection::class && get_class($videos[0]) === Video::class;
        });

        foreach ($videos as $video) {
            $response->assertSee($video->id);
            $response->assertSee($video->title);

        }
    }

    /**
     * @test
     */
    public function regular_users_cannot_manage_videos() {

        $this->loginAsRegularUser();

        $response = $this->get('/manage/videos');

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function guest_users_cannot_manage_videos() {

        $response = $this->get('/manage/videos');

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function superadmins_can_manage_videos()
    {
        // 1
        $this->loginAsSuperAdmin();

        // 2 executar
        $response = $this->get('/manage/videos');

        // 3 Provar assert
        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
    }

    /**
     * @test
     */
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