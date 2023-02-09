<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
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
            'photo' => 'nullable',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Creating array to store each song at its own index
        $records = [];
        // Getting the number of songs uploaded simultaniously
        $rowCount = count($formFields['name']);

        // Loop to iterate through data from request
        for ($i=0; $i < $rowCount; $i++) { 
            // Create row for each song
            $row = [];
            // Actually looping through the data
            foreach ($formFields as $key => $value) {
                // Check if the attribute is set
                // Necessary since it is possible to NOT upload photo for song
                if (isset($formFields[$key][$i])) {
                    // Adding attribute to row
                    $row[$key] = $formFields[$key][$i];
                }
            }
            // Pussing rows to array with songs
            array_push($records, $row);
        }

        // Loop to make additional checks and store data in database
        foreach ($records as $record) {
            // Checking if the featured was checked.
            if (!isset($record["featured"])) {
                $record["featured"] = false;
            } else {
                $record["featured"] = true;
            }
            // Checking if photo was uploaded. If yes, store photo in database + generate url
            if (isset($record['photo'])) {
                $record['photo'] = $record['photo']->store('photos/songs', 'public');
            }

            // Create song instance
            Song::create($record);
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
            if(Storage::disk('public')->exists($song->photo)) {
                Storage::disk('public')->delete($song->photo);
            }
        }
        // Deleting database record
        $song->delete();
        return back()->with('message', 'Song deleted');
    }
}
