<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('songs.index', [
            'songs' => Song::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.forms.song-form', [
            'albums' => Album::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validating inputs.
        $formFields = $request->validate([
            'name' => ['required'],
            'name.*' => ['required'],
            'spotify' => ['required'],
            'spotify.*' => ['required'],
            'apple' => ['required'],
            'apple.*' => ['required'],
            'album_id' => ['nullable'],
            'album_id.*' => ['nullable'],
            'featured' => ['nullable'],
            'featured.*' => ['nullable'],
            'photo' => ['nullable'],
            'photo.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],
        ]);

        // Creating array to store each song at its own index
        $records = [];
        // Getting the number of songs uploaded simultaniously
        $rowCount = count($formFields['name']);



        // // Loop to iterate through data from request
        for ($i = 0; $i < $rowCount; $i++) {
            // Crete new instance of song
            $song = new Song();

            // Fill in required attributes
            $song->name = $formFields['name'][$i];
            $song->spotify = $formFields['spotify'][$i];
            $song->apple = $formFields['apple'][$i];

            // Check if "featured" was pressed
            if (isset($formFields["featured"][$i])) {
                $song->featured = true;
            } else {
                $song->featured = false;
            }

            // Check if album was selected
            if (isset($formFields["album_id"][$i])) {
                $song->album_id = $formFields["album_id"][$i];
            }

            // Save instance
            $song->save();

            // Check if photo was added, if yes, create instance of Photo and save to database
            if (isset($formFields['photo'][$i])) {
                $url = $formFields['photo'][$i]->store('photos/songs', 'public');
                $song->photo()->create([
                    'url' => $url,
                ]);
            }
        }
        // Returning back to dashboard
        return redirect(route('dashboard'))->with('message', 'Song created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        // Validating inputs
        $formFields = $request->validate([
            'name' => ['required'],
            'spotify' => ['required'],
            'apple' => ['required'],
            'album_id' => ['nullable'],
            'featured' => ['nullable'],
        ]);

        // Checking if "featured" is set
        if (!isset($formFields['featured'])) {
            $formFields['featured'] = false;
        } elseif ($formFields['featured'] == 'on') {
            $formFields['featured'] = true;
        }

        // Updating entry in database
        $song->update($formFields);

        // Checking if new photo was uploaded 
        if ($request->file('photo')) {
            // Validating photo
            request()->validate([
                'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],
            ]);

            // Check if photo was already assigned to song and rewrite photo
            if ($song->photo) {
                if (Storage::disk('public')->exists($song->photo->url)) {
                    Storage::disk('public')->delete($song->photo->url);
                }
                $song->photo()->update([
                    'url' => $request->file('photo')->store('photos/songs', 'public'),
                ]);
            }
            // If song didn't have photo assigned to it, create new Photo instance
            else {
                $song->photo()->create([
                    'url' => $request->file('photo')->store('photos/songs', 'public'),
                ]);
            }
        }

        // Returning back to dashboard
        return back()->with('message', 'Song updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        // Checking if album has photo file and deleting if yes
        if (isset($song->photo)) {
            if (Storage::disk('public')->exists($song->photo->url)) {
                Storage::disk('public')->delete($song->photo->url);
            }
        }
        // Deleting related photo from database
        $song->photo()->delete();
        // Deleting database record
        $song->delete();

        // Redirect
        return back()->with('message', 'Song deleted');
    }
}
