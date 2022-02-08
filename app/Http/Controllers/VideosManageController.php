<?php

namespace App\Http\Controllers;

use App\Events\VideoCreated;
use App\Models\Video;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;
use Tests\Feature\Videos\VideosManageControllerTest;

class VideosManageController extends Controller
{

    public static function testedBy() {
        return VideosManageControllerTest::class;
    }

    /**
     * R -> Retrieve -> Llisto
     *
     */
    public function index()
    {
        return view('videos.manage.index',[
            'videos' => Video::all()
        ]);
    }

    /**
     * C -> Create -> Guarda a la base de dades el nou video
     */
    public function store(Request $request)
    {
        $video = Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
        ]);

        session()->flash('status', 'Successfully created');

        VideoCreated::dispatch($video);

        return redirect()->route('manage.videos');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('videos.manage.edit', ['video' => Video::findorFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $video = Video::findorFail($id);
        $video->title = $request->title;
        $video->description = $request->description;
        $video->url = $request->url;
        $video->save();

        session()->flash('status', 'Successfully updated');
        return redirect()->route('manage.videos');

    }

    public function destroy($id) {
        Video::find($id)->delete();
        session()->flash('status', 'Successfully removed');
        return redirect()->route('manage.videos');
    }
}
