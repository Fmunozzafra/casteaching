<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'videos' => Video::all();
        ]);
    }

    /**
     * C -> Create -> Mostra el formulari de creació
     */
    public function create()
    {
        //
    }

    /**
     * C -> Create -> Guarda a la base de dades el nou video
     */
    public function store(Request $request)
    {
        //
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

    /**
     * D -> DELETE
     */
    public function destroy($id)
    {
        //
    }
}
