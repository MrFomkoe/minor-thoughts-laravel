<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
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
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],
        ]);

        // Creating new instance of album
        $album = Album::create($formFields);

        // Checking if photo was uploaded
        if (isset($formFields['photo'])) {
            $photo = $formFields['photo'];
            // Using helper function to get paths. 
            // * 2nd parameter is additional path
            // * 3rd and 4th parameteres are width and height of cropped photo
            // * default values are 300px and 300px
            $paths = Photo::cropStorePhotos($photo, 'albums/');
            // Creating new instance of Photo and saving to database
            $album->photo()->create([
                'url' => $paths->photoPath,
                'preview_url' => $paths->previewPath,
            ]);
        }

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
        return view('albums.show', [
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
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],
        ]);

        // Updating and redirecting back
        $album->update($formFields);

        // Checking if new photo was uploaded 
        if (isset($formFields['photo'])) {
            $photo = $formFields['photo'];
            // Check if photo was already assigned to song and rewrite photo
            if ($album->photo) {
                if (Storage::disk('public')->exists($album->photo->url)) {
                    Storage::disk('public')->delete($album->photo->url);
                    Storage::disk('public')->delete($album->photo->preview_url);
                }
                $paths = Photo::cropStorePhotos($photo, 'albums/');
                $album->photo()->update([
                    'url' => $paths->photoPath,
                    'preview_url' => $paths->previewPath,
                ]);
            }
            // If song didn't have photo assigned to it, create new Photo instance
            else {
                $paths = Photo::cropStorePhotos($photo);
                $album->photo()->create([
                    'url' => $paths->photoPath,
                    'preview_url' => $paths->previewPath,
                ]);
            }
        }

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
            if (Storage::disk('public')->exists($album->photo->url)) {
                Storage::disk('public')->delete($album->photo->url);
                Storage::disk('public')->delete($album->photo->preview_url);
            }
        }
        // Deleting related photo from database
        $album->photo()->delete();
        // Deleting database record
        $album->delete();
        // Redirecting back
        return back()->with('message', 'Album deleted');
    }
}
