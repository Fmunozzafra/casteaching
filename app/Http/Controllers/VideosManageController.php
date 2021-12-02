<?php

namespace App\Http\Controllers;

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
        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
        ]);

        session()->flash('status', 'Successfully created');
        return redirect()->route('manage.videos');
    }

    /**
     * R -> NO LLISTA -> Individual ->
     */
    public function show($id)
    {
        //
    }

    /**
     * U -> update -> Form
     */
    public function edit($id)
    {
        //
    }

    /**
     * U -> update -> Processarà el Form i guardara les modificacions
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id) {
        Video::find($id)->delete();
        session()->flash('status', 'Successfully removed');
        return redirect()->route('manage.videos');
    }
}
