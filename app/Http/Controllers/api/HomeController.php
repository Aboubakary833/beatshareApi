<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;
use Owenoj\LaravelGetId3\GetId3;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = auth()->user();
        $data['musics'] = auth()->user()->musics;
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'music_file' => 'required|mimes:mp3|,mA4,mp4',
            'visibility' => 'required'
        ], [
            'required' => 'Ce champs est réquis',
            'mimes' => 'Votre fichier doit être de type mp3, mp4 ou mA4'
        ]);
        
        if ($validator->failed()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $inputs = [];
        $inputs['visibility'] = $request->visibility;


        if($file = $request->file('music_file')) {
            $music = $file->storeAs('public/' . auth()->user()->username, implode('', explode(' ', $file->getClientOriginalName())));
            $track = new GetId3($file);
            
            $inputs['name'] = $music;
            $inputs['picture'] = 'data:image/jpeg;base64,' . $track->getArtwork();
        }

        $inputs['uuid'] = Str::uuid();
        $inputs['userId'] = auth()->user()->id;

        Music::create($inputs);

        return response()->json(['success' => 'Le téléversement a été un succès!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $music = Music::where('uuid', $id)->first();
        rm
    }
}
