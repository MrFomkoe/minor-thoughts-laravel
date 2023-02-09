<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('albums.index', [
            'albums' => Album::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.forms.album-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validating inputs
        $formFields = $request->validate([
            'name' => ['required'],
            'spotify' => ['required'],
            'apple' => ['required'],
            'photo' => ['nullable', 'image'],
        ]);

        // Saving photo if it has been added to record
        if (isset($formFields['photo'])) {
            $formFields['photo'] = $formFields['photo']->store('photos/albums', 'public');
        }

        // Creating new instance of album
        Album::create($formFields);

        // Redirecting back to dashboard
        return redirect(route('dashboard'))->with('message', 'Album created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        // Getting songs for the subject album
        $songs = $album->songs()->get();

        // Returning view
        return view('albums.show' , [
            'album' => $album,
            'songs' => $songs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        // Validating inputs
        $formFields = $request->validate([
            'name' => ['required'],
            'spotify' => ['required'],
            'apple' => ['required'],
        ]);

        // Updating and redirecting back
        $album->update($formFields);
        return back()->with('message', 'Album updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        // Checking if album has photo file and deleting if yes
        if (isset($album->photo)) {
            if(Storage::disk('public')->exists($album->photo)) {
                Storage::disk('public')->delete($album->photo);
            }
        }
        // Deleting database record
        $album->delete();
        // Redirecting back
        return back()->with('message', 'Album deleted');
    }
}
